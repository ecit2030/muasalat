<?php

namespace App\Datatables\Dashboard\Track;

use App\Models\Track;
use App\Models\User;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class TrackDatatable extends BaseDatatable
{
    protected ?string $actionable;

    public function __construct()
    {
        $this->actionable = auth()->user()->hasRole("admin") ? 'show' : 'delete|show|edit|create';
    }

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = Track::query()->withoutRoute()->latest();
        } elseif ($organization) {
            $data = Track::query()->withoutRoute()->whereOwnerId(auth()->id())->latest();
        } elseif ($moderator) {
            $data = Track::query()->withoutRoute()->whereOwnerId(auth()->user()->organization_id)->latest();
        }

        return $data;
    }

    protected function getCustomColumns(): array
    {
        $data = [
            'active' => function ($model) {
                return view('components.datatable.includes.columns.active', ['active' => $model?->is_active ? true : false]);
            },
            'driver' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->driver?->name]);
            },
        ];

        if (auth()->user()->hasRole("admin")) {
            $data["ownerName"] = function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->owner?->name]);
            };
            $data["ownerRole"] = function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->owner?->roles()?->first()?->name]);
            };
        }

        return $data;
    }

    protected function getColumns(): array
    {
        $data = [
            Column::make('name')->title(t_('name')),
            Column::make('driver')->title(t_('driver')),
            Column::computed('active')->title(t_('Status')),
        ];

        if (auth()->user()->hasRole("admin")) {
            array_push(
                $data,
                Column::make('ownerName')->title(t_('owner name'))
            );
            array_push(
                $data,
                Column::make('ownerRole')->title(t_('owner role'))
            );
        };
        return $data;
    }

    protected function getFilters(): array
    {
        $data = [
            'name' => function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            },
            'driver' => function ($query, $keyword) {
                $query->whereRelation('driver', 'name', 'like', '%' . $keyword . '%')
                    ->orWhereRelation('owner', 'name', 'like', '%' . $keyword . '%');
            },
        ];
        if (auth()->user()->hasRole("admin")) {
            $isAdmin = [
                'ownerName' => function ($query, $keyword) {
                    $query->whereRelation('owner', 'name', 'like', '%' . $keyword . '%');
                },
                'ownerRole' => function ($query, $keyword) {
                    $query->whereHas('owner', function ($query) use ($keyword) {
                        $query->whereRelation('roles', 'name', 'like', '%' . $keyword . '%');
                    });
                },
            ];
            $data = array_merge($data, $isAdmin);
        }
        return $data;
    }
}