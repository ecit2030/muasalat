<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('chats', function (Blueprint $table) {

            // 1️⃣ Drop foreign keys (names may differ!)
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);

            // 2️⃣ Drop old unique index
            $table->dropUnique('chats_sender_id_receiver_id_unique');

            // 3️⃣ Add new correct unique index
            $table->unique(
                ['trip_id', 'sender_id', 'receiver_id'],
                'chats_trip_sender_receiver_unique'
            );

            // 4️⃣ Re-add foreign keys
            $table->foreign('sender_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('receiver_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {

            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);

            $table->dropUnique('chats_trip_sender_receiver_unique');

            $table->unique(
                ['sender_id', 'receiver_id'],
                'chats_sender_id_receiver_id_unique'
            );

            $table->foreign('sender_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('receiver_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
