<?php

namespace App\Datatables\Dashboard\Notification;

use App\Models\Notification;
use App\Support\Datatables\BaseDatatable;
use App\Support\Datatables\CustomFilters;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class NotificationDatatable extends BaseDatatable
{
    protected ?string $actionable = 'create|show|delete';

    public function query(): Builder
    {
        return Notification::whereNotifiableId(auth()->id())->orWhere("data->notifier_id", "=", auth()->id())->groupBy("data->title")->groupBy("data->message")->latest();
    }

    protected function getCustomColumns(): array
    {
        return [
            'title' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => mb_substr(($model?->data["title"][app()->getLocale()] ?? $model->data["title"] ?? ""),0,25,'UTF-8') . "..." ]);
            },

            'message' => function ($model) {
                return view('components.datatable.includes.columns.title', ["title" => mb_substr(($model?->data["message"][app()->getLocale()] ?? $model->data["message"] ?? ""),0,25,'UTF-8') . "..." ]);
            },

        ];
    }


    protected function getColumns(): array
    {
        return [
            Column::make('title')->title(t_('message title')),
            Column::make('message')->title(t_('message')),
        ];
    }

    protected function getFilters(): array
    {
        $data = [
            'title' => function ($query, $keyword) {
                $query->where('data->title', 'like', '%' . $keyword . '%');
            },
            'message' => function ($query, $keyword) {
                $query->where('data->message', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }
}
