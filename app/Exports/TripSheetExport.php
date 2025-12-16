<?php

namespace App\Exports;

use App\Models\Trip;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;

class TripSheetExport implements FromArray, Responsable, WithHeadings,ShouldAutoSize
{
    use Exportable;

    private $fileName = 'singletrip.xlsx';
    private $writerType = Excel::XLSX;
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    private $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    /**
     * @return array
     */
    public function array(): array
    {
//        $endtime = explode(':', $this->trip?->destination['duration']);
        $trip = [
            "Date" => $this->trip?->date,
//            "Track Name" => $this->trip?->track?->name,
            "Start Time" =>  $this->trip?->time,
//            "End Time" => Carbon::createFromFormat('H:i', $this->trip?->origin['start_time'])
//                ->addHours($endtime[0])->addMinutes($endtime[1])->translatedFormat('h:i a'),
            "Driver Name" => $this->trip?->driver?->name,
//            "Organization Name" => $this->trip?->track?->owner?->name ?? '',
//            "Driver Rate" => $this->trip?->track?->driver?->rate,
            "Car Name" => $this->trip?->driver?->vehicle?->year?->model?->name . ' ( ' . $this->trip?->track?->vehicle?->year?->model?->brand?->name . ' )',
            "Car Model" => $this->trip?->driver?->vehicle?->year?->year,
            "Car Owner" => $this->trip?->driver?->vehicle?->driver?->name ?? $this->trip?->track?->vehicle?->user?->name,
            "Car Type" => !is_null($this->trip?->driver?->vehicle?->driver) ? __('driver') : __('organization'),
            "Client Name" => $this->trip?->client?->name,
            "Client E-Mail" => $this->trip?->client?->email,
            "Client Phone" => $this->trip?->client?->phone,
            "Kilometer Price" => $this->trip?->km_price,
            "Grand Total" => $this->trip?->report?->total,
            "Invoice" => url('/client/trip/get-details-pdf/' . $this->trip?->report?->id . '/' . get_current_lang()),
        ];
        return array($trip);
    }

    public function headings(): array
    {
        return [
            "Date",
//            "Track Name",
            "Start Time",
//            "End Time",
            "Driver Name",
//            "Organization Name",
//            "Driver Rate",
            "Car Name",
            "Car Model",
            "Car Owner",
            "Car Type",
            "Client Name",
            "Client E-Mail",
            "Client Phone",
            "Kilometer Price",
            "Grand Total",
            "Invoice",
        ];
    }
}
