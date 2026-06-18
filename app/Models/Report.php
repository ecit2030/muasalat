<?php

namespace App\Models;

use App\Http\Resources\Api\Client\Trip\ReportResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Trip.
 *
 * @mixin \Eloquent
 */
class Report extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public bool $addToPermission = true;

    protected $fillable = [
        "sub_total",
        "tax_value",
        "tax",
        "total",
        "total_km",
        "duration",
        "km_price",
        "reservation_type",
        "is_paid",
        "payment_method",
        "start_date",
        "end_date",
        "accepted_time",
        "accepted_time_for_driver",
        "app_commission",
        "transaction_id",
        "card_payment_method",
        "card_payment_status",
        "payment_unique_id",
    ];

    protected $casts = [
        'sub_total' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'km_price' => 'decimal:2',
        'tax_value' => 'decimal:2',
        'total_km' => 'decimal:2',
    ];

//    public function registerMediaCollections(): void
//    {
//        $this->addMediaCollection('receiptPDF')
//            ->singleFile()
//            ->useDisk(env('FILESYSTEM_DISK') ?? 'public');
//
//        $this->addMediaCollection('receiptQR')
//            ->singleFile()
//            ->useDisk(env('FILESYSTEM_DISK') ?? 'public');
//    }

    public function receipt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($this->getFirstMediaUrl('receiptPDF') != '' ? $this->getFirstMediaUrl('receiptPDF') : ''),
        );
    }

    public function receiptPath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($this->getFirstMediaPath('receiptPDF') != '' ? $this->getFirstMediaPath('receiptPDF') : ''),
        );
    }

    public function qr(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($this->getFirstMediaUrl('receiptQR') != '' ? $this->getMedia('receiptQR')?->last()?->getUrl() : ''),

        );
    }

    public function qrStr($receiptUrl = '' ,$filePath = null)
    {
        $content = QrCode::format('svg')
            ->margin(5)
            ->size(256)
            ->generate($receiptUrl,$filePath);
        return is_string($content) ? $content : (string)$content;
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
