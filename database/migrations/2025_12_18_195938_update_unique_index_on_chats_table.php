<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1️⃣ Remove duplicate chats (keep only the oldest)
        DB::statement("
            DELETE c1
            FROM chats c1
            INNER JOIN chats c2
                ON c1.sender_id = c2.sender_id
                AND c1.receiver_id = c2.receiver_id
                AND c1.trip_id = c2.trip_id
                AND c1.id > c2.id
        ");

        Schema::table('chats', function (Blueprint $table) {
            // 2️⃣ Temporarily disable foreign key checks
            Schema::disableForeignKeyConstraints();

            // 3️⃣ Drop old unique index
            if (Schema::hasColumn('chats', 'sender_id') && Schema::hasColumn('chats', 'receiver_id')) {
                $table->dropUnique('chats_sender_id_receiver_id_unique');
            }

            // 4️⃣ Add new unique index
            $table->unique(['trip_id', 'sender_id', 'receiver_id'], 'chats_trip_sender_receiver_unique');

            // 5️⃣ Re-enable foreign key checks
            Schema::enableForeignKeyConstraints();
        });
    }

    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();

            $table->dropUnique('chats_trip_sender_receiver_unique');
            $table->unique(['sender_id', 'receiver_id'], 'chats_sender_id_receiver_id_unique');

            Schema::enableForeignKeyConstraints();
        });
    }
};
