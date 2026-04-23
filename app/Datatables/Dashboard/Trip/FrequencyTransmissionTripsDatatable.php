<?php

namespace App\Datatables\Dashboard\Trip;

use App\Models\Trip;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class FrequencyTransmissionTripsDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        $data = Trip::query()
            ->where(function ($q) {
                $q->where('trip_type', 'frequency')
                    ->orWhereHas('report', function ($qr) {
                        $qr->where('reservation_type', 'frequency');
                    });
            })
            ->orderByDesc('created_at');

        if ($organization) {
            $data->whereHas("driver", function ($q) {
                $q->whereHas('driverOrg', function ($q) {
                    $q->where('id', auth()->id());
                });
            });
        } elseif ($moderator) {
            $data->whereHas("driver", function ($q) {
                $q->whereHas('driverOrg', function ($q) {
                    $q->where('organization_id', auth()->user()->organization_id);
                });
            });
        } elseif (!$admin) {
            // fallback: if role is not recognized, return empty set
            $data->whereRaw('1 = 0');
        }

        return $data->orderBy('id', 'DESC');
    }

    protected function getCustomColumns(): array
    {
        return [
            'time' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model?->time ?? '--']);
            },
            'vehicle' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->driver?->vehicle?->vehicleName]);
            },
            'driverName' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->driver?->name ?? '--']);
            },
            'clientName' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => $model->client?->full_name ?? $model->client?->username ?? $model->client?->name ?? '--']);
            },
            'trip_start_point' => function ($model) {
                $title = $model->origin['location'] ?? ($model->origin['address'] ?? '--');
                return view('components.datatable.includes.columns.title', ["title" => $title]);
            },
            'trip_end_point' => function ($model) {
                $title = $model->destination['location'] ?? ($model->destination['address'] ?? '--');
                return view('components.datatable.includes.columns.title', ["title" => $title]);
            },
            'report' => function ($model) {
                if (!$model->report?->id) {
                    return '--';
                }
                return view('components.datatable.includes.columns.report', [
                    "report" => url('/client/trip/get-details-pdf/' . $model->report->id . '/' . get_current_lang())
                ]);
            },
        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('date')->title(t_('date')),
            Column::make('time')->title(t_('time')),
            Column::computed('driverName')->title(t_('driver')),
            Column::computed('clientName')->title(t_('client')),
            Column::computed('trip_start_point')->title(__('messages.trip start point')),
            Column::computed('trip_end_point')->title(__('messages.trip end point')),
            Column::computed('vehicle')->title(t_('vehicle')),
            Column::computed('report')->title(t_('e-invoice')),
        ];
    }

    protected function getFilters(): array
    {
        return [
            'date' => function ($query, $keyword) {
                $query->where('date', 'like', '%' . $keyword . '%');
            },
            'time' => function ($query, $keyword) {
                $query->where('time', 'like', '%' . $keyword . '%');
            },
            'driverName' => function ($query, $keyword) {
                $query->whereRelation('driver', 'name', 'like', '%' . $keyword . '%');
            },
            'clientName' => function ($query, $keyword) {
                $query->whereRelation('client', 'name', 'like', '%' . $keyword . '%');
            },
        ];
    }
}

