<?php

namespace App\Datatables\Dashboard\Report;

use App\Models\Report;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class ReportDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = Report::query()->groupBy("date")->orderBy("date","ASC")->latest();
        } elseif ($organization) {
            $data = Report::query()->groupBy("date")->orderBy("date","ASC")->whereHas("track", function ($q) {
                $q->whereOwnerId(auth()->id());
            })->latest();
        } elseif ($moderator) {
            $data = Report::query()->groupBy("date")->orderBy("date","ASC")->whereHas("track", function ($q) {
                $q->whereOwnerId(auth()->user()->organization_id);
            })->latest();
        }
        return $data;
    }


    protected function getCustomColumns(): array
    {
        return [

            'time' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->track->origin["start_time"]]);
            },

            'vehicle' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->track->vehicleName]);
            },

            'trackName' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->track->name]);
            },

            'countBooked' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => Report::where(["track_id" => $model->track_id, "date" => $model->date])->count()]);
            },

        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('date')->title(t_('date')),
            Column::computed('time')->title(t_('time')),
            Column::computed('trackName')->title(t_('track')),
            Column::computed('vehicle')->title(t_('vehicle')),
            Column::computed('countBooked')->title(t_('count booked')),
        ];
    }
}
