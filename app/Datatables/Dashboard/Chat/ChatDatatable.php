<?php

namespace App\Datatables\Dashboard\Chat;

use App\Models\ChatMessage;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Column;

class ChatDatatable extends BaseDatatable
{
    protected ?string $actionable = 'show';

    public function query(): Builder
    {
        return ChatMessage::query()
            ->select('chat_messages.*')
            ->join('chats', 'chat_messages.chat_id', '=', 'chats.id')
            ->join(DB::raw('(SELECT chat_id, MAX(created_at) as latest FROM chat_messages GROUP BY chat_id) as latest_messages'), function ($join) {
                $join->on('chat_messages.chat_id', '=', 'latest_messages.chat_id')
                    ->on('chat_messages.created_at', '=', 'latest_messages.latest');
            })
            ->when(request('status') && request('status') == 'read', function ($q) {
                $q->whereNotNull('read_at');
            })->when(request('status') && request('status') == 'unread', function ($q) {
                $q->whereNull('read_at');
            })->when(request('username'), function ($q) {
                $q->whereHas('chat', function ($q) {
                    $q->whereHas('sender', function ($q) {
                        $q->where('name', 'like', '%' . request()->username . '%');
                    });
                });
            })->when(request('email'), function ($q) {
                $q->whereHas('chat', function ($q) {
                    $q->whereHas('sender', function ($q) {
                        $q->where('email', 'like', '%' . request()->email . '%');
                    });
                });
            })->when(request('phone'), function ($q) {
                $q->whereHas('chat', function ($q) {
                    $q->whereHas('sender', function ($q) {
                        $q->where('phone', 'like', '%' . request()->phone . '%');
                    });
                });
            })
            ->orderBy('chat_messages.created_at', 'DESC');
    }

    protected function getCustomColumns(): array
    {
        return [
            'client' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->chat?->sender?->full_name ?? $model->chat?->sender?->name ?? '--']);
            },
            'mobile' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->chat?->sender?->phone ?? '--']);
            },
            'email' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->chat?->sender?->email ?? '--']);
            },
            'message' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->message]);
            },
            'date' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model->created_at->format('Y-m-d H:i')]);
            },
            'status' => function ($model) {
                $title = $model->read_at ? __('messages.read') : __('messages.unread');
                return view('components.datatable.includes.columns.status-text', ['done' => $model->read_at, 'title' => $title]);
            },
        ];
    }

    protected function getActions($model): array
    {
        $activateTitlelog = t_('activate');
        $deactivateTitlelog = t_('deactivate');

        if ($model->is_active) {
            $action = [
                'deactivate' => <<<HTML
            <a href='#deactivationModal' class="btn btn-icon  btn-active-color-danger btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$deactivateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-x"></i> </a></a>
            HTML
            ];
        } else {
            $action = [
                'activate' => <<<HTML
            <a href='#activationModal' class="btn btn-icon  btn-active-color-success btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$activateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-check"></i> </a></a>
            HTML
            ];
        }

        return [];
    }


    protected function getColumns(): array
    {
        return [
            Column::make('client')->title(__('messages.username')),
            Column::make('mobile')->title(__('messages.mobile')),
            Column::make('email')->title(__('messages.email')),
            Column::make('message')->title(__('messages.last message')),
            Column::make('date')->title(__('messages.last message date')),
            Column::make('status')->title(__('messages.messages status')),
        ];
    }

    protected function postAjaxAction(): array
    {
        return ['data' => 'function(d) {
            d.status = $("#status").val();
            d.username = $("#username").val();
            d.email = $("#email").val();
            d.phone = $("#phone").val();
         }',
        ];
    }
}
