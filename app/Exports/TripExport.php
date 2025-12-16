<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Excel;

class TripExport implements WithMultipleSheets ,Responsable
{
    use Exportable;
    private $fileName = 'tracktrips.xlsx';
    private $writerType = Excel::XLSX;
    private $headers = [
        'Content-Type' => 'text/csv',
    ];
    private $trips;

    public function __construct($trips)
    {
        $this->trips = $trips;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->trips as $trip) {
            $sheets[] = new TripSheetExport($trip);
        }
        return $sheets;
    }
}
