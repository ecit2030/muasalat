<?php

namespace App\Datatables\Dashboard\Trip;

use App\Models\Trip;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class TripDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = Trip::query()->orderByDesc("created_at");
        } elseif ($organization) {
            $data = Trip::query()->orderByDesc("created_at")
                ->whereHas("driver", function ($q) {
                    $q->whereHas('driverOrg', function ($q) {
                        $q->where('id', auth()->id());
                    });
                });
        } elseif ($moderator) {
            $data = Trip::query()->orderByDesc("created_at")
                ->whereHas("driver", function ($q) {
                    $q->whereHas('driverOrg', function ($q) {
                        $q->where('organization_id', auth()->user()->organization_id);
                    });
                });
        }
        // Exclude frequency bookings from the main Trips page
        $data->where(function ($q) {
            $q->whereNull('trip_type')
                ->orWhere('trip_type', '!=', 'frequency');
        })->whereDoesntHave('report', function ($qr) {
            $qr->where('reservation_type', 'frequency');
        });

        return $data->orderBy('id','DESC');
    }


    protected function getCustomColumns(): array
    {
        return [
            'trip_type' => function ($model) {
                $type = $model?->trip_type ?: ($model?->report?->reservation_type ?: '--');
                return view('components.datatable.includes.columns.title', ["title" => $type]);
            },

            'time' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model?->time ?? '--']);
            },

            'vehicle' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->driver?->vehicle?->vehicleName]);
            },

//            'trackName' => function ($model) {
//                return view('components.datatable.includes.columns.title', ["title" => $model->track->name]);
//            },

            'clientName' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->client?->full_name ?? $model->client?->username ?? $model->client?->name ?? '--']);
            },

            'trip_start_point' => function ($model) {
                $title = $model->origin['location'];
                return view('components.datatable.includes.columns.title', ["title" => $title]);
            },

            'trip_end_point' => function ($model) {
                $title = $model->destination['location'];
                return view('components.datatable.includes.columns.title', ["title" => $title]);
            },

//            'countBooked' => function ($model) {
//                return view('components.datatable.includes.columns.title', ["title" => Trip::where(["track_id" => $model->track_id, "date" => $model->date])->count()]);
//            },

            'report' => function ($model) {
                if (!$model->driver()->exists()) {
                    return '--';
                }
                return view('components.datatable.includes.columns.report',
                    ["report" => url('/client/trip/get-details-pdf/' . $model?->report?->id . '/' . get_current_lang())]);
            },

            'export' => function ($model) {
                if (!$model->driver()->exists()) {
                    return '--';
                }
                return view('components.datatable.includes.columns.export',
                    ["route" => "dashboard.trips.trips.exporttrip", "parameter" => ["trip" => $model]]);
            },
        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('trip_type')->title(t_('trip_type')),
            Column::make('date')->title(t_('date')),
            Column::make('time')->title(t_('time')),
//            Column::make('trackName')->title(t_('track')),
            Column::make('clientName')->title(t_('client')),
            Column::make('trip_start_point')->title(__('messages.trip start point')),
            Column::make('trip_end_point')->title(__('messages.trip end point')),
            Column::make('vehicle')->title(t_('vehicle')),
//            Column::computed('countBooked')->title(t_('count booked')),
            Column::computed('report')->title(t_('e-invoice')),
            Column::computed('export')->title(t_('export excel')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'trip_type' => function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('trip_type', 'like', '%' . $keyword . '%')
                        ->orWhereHas('report', function ($qr) use ($keyword) {
                            $qr->where('reservation_type', 'like', '%' . $keyword . '%');
                        });
                });
            },
            'date' => function ($query, $keyword) {
                $query->where('date', 'like', '%' . $keyword . '%');
            },
            'time' => function ($query, $keyword) {
                $query->where('origin->start_time', 'like', '%' . $keyword . '%');
            },
//            'trackName' => function ($query, $keyword) {
//                $query->whereRelation('track', 'name', 'like', '%' . $keyword . '%');
//            },
            'clientName' => function ($query, $keyword) {
                $query->whereRelation('client', 'name', 'like', '%' . $keyword . '%');
            },
            'vehicle' => function ($query, $keyword) {
                $query->whereHas('driver', function ($query) use ($keyword) {
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
}
