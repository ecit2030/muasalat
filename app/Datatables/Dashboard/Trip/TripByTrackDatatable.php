<?php

namespace App\Datatables\Dashboard\Trip;

use App\Models\Trip;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class TripByTrackDatatable extends BaseDatatable
{
    protected ?string $actionable = 'showtrack';

    public function query(): Builder
    {
        dd(5);
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = Trip::query()->groupBy(["date", "origin->start_time", "track_id"])->orderByDesc("date")->orderBy("track_id")->orderBy("origin->start_time");
        } elseif ($organization) {
            $data = Trip::query()->groupBy(["date", "origin->start_time", "track_id"])->orderByDesc("date")->orderBy("track_id")->orderBy("origin->start_time")->whereHas("track", function ($q) {
                $q->whereOwnerId(auth()->id());
            });
        } elseif ($moderator) {
            $data = Trip::query()->groupBy(["date", "origin->start_time", "track_id"])->orderByDesc("date")->orderBy("track_id")->orderBy("origin->start_time")->whereHas("track", function ($q) {
                $q->whereOwnerId(auth()->user()->organization_id);
            });
        }
        return $data;
    }


    protected function getCustomColumns(): array
    {
        return [

            'time' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->origin["start_time"]]);
            },

            'vehicle' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->track->vehicleName]);
            },

            'trackName' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->track->name]);
            },

            'countBooked' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => Trip::where(["track_id" => $model->track_id, "date" => $model->date])->count()]);
            },

            'report' => function ($model) {
                return view('components.datatable.includes.columns.trackReport', ["track" => $model?->track_id, "date" => $model->date, "time" => $model->origin["start_time"]]);
            },

            'export' => function ($model) {
                return view('components.datatable.includes.columns.export', ["route" => "dashboard.trips.trips.exporttracktrips", "parameter" => ["track" => $model?->track_id , "date" => $model?->date , "time" => $model?->origin["start_time"]]]);
            },
        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('date')->title(t_('date')),
            Column::make('time')->title(t_('time')),
            Column::make('trackName')->title(t_('track')),
            Column::make('vehicle')->title(t_('vehicle')),
            Column::computed('countBooked')->title(t_('count booked')),
            Column::computed('report')->title(t_('e-invoice')),
            Column::computed('export')->title(t_('export excel')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'date' => function ($query, $keyword) {
                $query->where('date', 'like', '%' . $keyword . '%');
            },
            'time' => function ($query, $keyword) {
                $query->where('origin->start_time', 'like', '%' . $keyword . '%');
            },
//            'trackName' => function ($query, $keyword) {
//                $query->whereRelation('track', 'name', 'like', '%' . $keyword . '%');
//            },
            'vehicle' => function ($query, $keyword) {
                $query->whereHas('track', function ($query) use ($keyword) {
                    $query->whereHas('vehicle', function ($query) use ($keyword) {
                        $query->whereHas('year', function ($query) use ($keyword) {
                            $query->where('year', 'like', '%' . $keyword . '%')
                                ->orWhereHas('model', function ($query) use ($keyword) {
                                    $query->where('name->' . get_current_lang(), 'like', '%' . $keyword . '%')
                                        ->orWhereRelation('brand', 'name->' . get_current_lang(), 'like', '%' . $keyword . '%');
                                });
                        });
                    });
                });
            },
        ];
        return $data;
    }

    protected function getActions($model): array
    {
        $show = route('dashboard.trips.trips.showtrack', ['id' => $model->id]);
        $showTitlelog = t_('title show');

        return [
            'showtrack' => <<<HTML
        <a href='{$show}' class="btn btn-icon  btn-active-color-success btn-sm me-1" data-toggle="tooltip"  title="{$showTitlelog}" ><i class="bi bi-eye"></i> </a></a>
        HTML,
        ];
    }
}
