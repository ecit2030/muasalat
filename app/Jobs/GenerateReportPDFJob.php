<?php

namespace App\Jobs;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use \PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GenerateReportPDFJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Report $report;
    public $locale, $appname, $address, $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($report, $locale, $appname, $address, $user)
    {
        $this->report = $report;
        $this->locale = $locale;
        $this->appname = $appname;
        $this->address = $address;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->report->load('trips');
        $pdfName = 'report' . $this->report->id . '.pdf';
        PDF::loadView('invoice', [
            'report' => $this->report,
            'locale' => $this->locale,
            'appname' => $this->appname,
            'address' => $this->address,
            'user' => $this->user,
        ])->save(storage_path('app/temp/' . $pdfName));

        if (Storage::disk('local')->exists('temp/' . $pdfName)) {
            $this->report->addMedia(new UploadedFile(Storage::disk('local')->path('temp/report' . $this->report->id . '.pdf'), time() . '.pdf'))->toMediaCollection('receiptPDF');
            $this->report->refresh();
            $this->report->qrStr($this->report->receipt, Storage::disk('local')->path('temp/' . $this->report->id . '.svg'));
            if (Storage::disk('local')->exists('temp/' . $this->report->id . '.svg')) {
                $this->report->addMedia(new UploadedFile(Storage::disk('local')->path('temp/' . $this->report->id . '.svg'), time() . '.svg'))->toMediaCollection('receiptQR');
                $this->report->refresh();
            }
        }
    }
}
