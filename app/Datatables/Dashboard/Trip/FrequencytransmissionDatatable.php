<?php

namespace App\Datatables\Dashboard\Trip;

use App\Models\FrequencyTransmission;
use App\Support\Datatables\BaseDatatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class FrequencyTransmissionDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show|delete';

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = FrequencyTransmission::query()->orderByDesc("created_at");

        } elseif ($organization) {
            $data = FrequencyTransmission::query()->orderByDesc("created_at")
                ->whereHas("driver", function ($q) {
                    $q->whereHas('driverOrg', function ($q) {
                        $q->where('id', auth()->id());
                    });
                });

        } elseif ($moderator) {
            $data = FrequencyTransmission::query()->orderByDesc("created_at")
                ->whereHas("driver", function ($q) {
                    $q->whereHas('driverOrg', function ($q) {
                        $q->where('organization_id', auth()->user()->organization_id);
                    });
                });
        }

        $status = request('status');
        $now = Carbon::now();

        $data = match ($status) {
            // finished/completed
            'completed', 'finished' => $data->where('is_active', 0),

            // driver waiting / refused
            'driver_waiting', 'waiting', 'pending' => $data->where('status_driver', 0),
            'driver_refused', 'refused', 'rejected' => $data->where('status_driver', 2),

            // upcoming
            'scheduled' => $data->where('is_active', 1)->where('date_trans', '>', $now),

            // started/active
            'current', 'ongoing' => $data->where('is_active', 1)->where('date_trans', '<=', $now),

            default => $data,
        };

        return $data->orderBy('id', 'DESC');
    }

    protected function getCustomColumns(): array
    {
        return [

            'name' => function ($model) {
                return view('components.datatable.includes.columns.title', [
                    "title" => $model->name ?? '--'
                ]);
            },

            'driver' => function ($model) {
                return view('components.datatable.includes.columns.title', [
                    "title" => $model->driver?->name ?? '--'
                ]);
            }, 

            'origin' => function ($model) {
                $title = $model->origin['location'] ?? '--';
                return view('components.datatable.includes.columns.title', ["title" => $title]);
            },

            'destination' => function ($model) {
                $title = $model->destination['location'] ?? '--';
                return view('components.datatable.includes.columns.title', ["title" => $title]);
            },

            'date_trans' => function ($model) {
                return view('components.datatable.includes.columns.title', [
                    "title" => $model->date_trans ?? '--'
                ]);
            },

            'oneway_price' => function ($model) {
                return view('components.datatable.includes.columns.title', [
                    "title" => $model->oneway_price ?? '--'
                ]);
            },

            'round_price' => function ($model) {
                return view('components.datatable.includes.columns.title', [
                    "title" => $model->round_price ?? '--'
                ]);
            },

            'status_driver' => function ($model) {
                return match ($model->status_driver) {
                    1 => '<span class="badge bg-success">Accepted</span>',
                    2 => '<span class="badge bg-danger">Refused</span>',
                    default => '<span class="badge bg-warning">Pending</span>',
                };
            },

            'is_active' => function ($model) {
                return $model->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-secondary">Inactive</span>';
            },
        ];
    }

    protected function getColumns(): array
    {
        return [
            Column::make('name')->title('Name'),
            Column::computed('driver')->title('Driver'),
            Column::computed('origin')->title('Start Point'),
            Column::computed('destination')->title('End Point'),
            Column::computed('date_trans')->title('Date'),
            Column::computed('oneway_price')->title('One Way Price'),
            Column::computed('round_price')->title('Round Price'),
            Column::computed('status_driver')->title('Driver Status'),
            Column::computed('is_active')->title('Active'),
        ];
    }

    protected function getFilters(): array
    {
        return [

            'name' => function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            },

            'driver' => function ($query, $keyword) {
                $query->whereRelation('driver', 'name', 'like', '%' . $keyword . '%');
            },

            'vehicle' => function ($query, $keyword) {
                $query->whereRelation('vehicle', 'name', 'like', '%' . $keyword . '%');
            },

            'date_trans' => function ($query, $keyword) {
                $query->where('date_trans', 'like', '%' . $keyword . '%');
            },

            'origin' => function ($query, $keyword) {
                $query->where('origin->location', 'like', '%' . $keyword . '%');
            },

            'destination' => function ($query, $keyword) {
                $query->where('destination->location', 'like', '%' . $keyword . '%');
            },
        ];
    }


    protected function getActions($model): array
    {
        return [
            'change_driver' => view('components.datatable.includes.actions.change_driver', [
                'id' => $model->id,
                'driver_id' => $model->driver_id,
                'status_driver' => $model->status_driver,
            ])->render(),
        ];
    }
}