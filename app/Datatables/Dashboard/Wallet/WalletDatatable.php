<?php

namespace App\Datatables\Dashboard\Wallet;

use App\Models\UserWithdraw;
use App\Support\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class WalletDatatable extends BaseDatatable
{
    protected ?string $actionable;


    public function __construct()
    {
        $this->actionable = request("status") == "pending" ? "accept|decline" : '';
    }

    public function query(): Builder
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $data = UserWithdraw::whereStatus(request("status"))->latest();
        } elseif ($organization) {
            $data = UserWithdraw::whereStatus(request("status"))->whereUserId(auth()->id())->latest();
        } elseif ($moderator) {
            $data = UserWithdraw::whereStatus(request("status"))->whereUserId(auth()->user()->organization_id)->latest();
        }

        return $data;
    }

    protected function getCustomColumns(): array
    {
        $general = setting('general');
        $appPercentage = +data_get($general, "appPercentage");
        return [
            'name' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->user->name]);
            },
            'role' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->user->roles()->first()->name]);
            },
            'iban' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->user?->iban]);
            },
            'bank_name' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->user?->bank_name]);
            },
            'balance' => function ($model) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->balance]);
            },
            'amount_for_driver' => function ($model) use ($appPercentage) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->balance]);
            },
            // 'amount_for_app' => function ($model) use ($appPercentage) {
            //     return view('components.datatable.includes.columns.title', ['title' => $model?->balance * $appPercentage  / 100]);
            // },
            'state' => function ($model) {
                return view('components.datatable.includes.columns.withdrawStatus', ['status' => $model?->status]);
            },
            'created_at' => function ($model) use ($appPercentage) {
                return view('components.datatable.includes.columns.title', ['title' => $model?->created_at->format('Y-m-d H:i')]);
            },
        ];
    }

    protected function getActions($model): array
    {

        $admin = auth()->user()->hasRole("admin");

        if ($admin && request("status") == "pending") {

            $activateTitlelog = t_('accept');
            $deactivateTitlelog = t_('revoke');

            return   [
                'deactivate' => <<<HTML
                    <a href='#deactivationModal' class="btn btn-icon  btn-active-color-danger btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$deactivateTitlelog}" data-bs-toggle="modal" data-bs-target="#deactivationModal" ><i class="fas fa-x"></i> </a></a>
                    HTML,
                'activate' => <<<HTML
                    <a href='#activationModal' class="btn btn-icon  btn-active-color-success btn-sm me-1 fs-5" data-toggle="tooltip" data-user_id="$model->id" title="{$activateTitlelog}" data-bs-toggle="modal" data-bs-target="#activationModal" ><i class="fas fa-check"></i> </a></a>
                    HTML
            ];
        } else {
            return [];
        }
    }
    protected function getColumns(): array
    {
        $columns = [
            Column::make('name')->title(t_('name')),
            Column::make('role')->title(t_('type')),
            Column::make('iban')->title(t_('iban')),
            Column::make('bank_name')->title(t_('bank name')),
            Column::make('balance')->title(t_('balance')),
            Column::computed('amount_for_driver')->title(t_('amount for type')),
            // Column::computed('amount_for_app')->title(t_('amount for app')),
            Column::computed('state')->title(t_('Status')),
            Column::make('created_at')->title(__('Withdraw date')),
        ];

        if (request("status") == "declined") {
            array_push($columns, Column::make('reason')->title(t_('reason')));
        }

        return $columns;
    }

    protected function getFilters(): array
    {
        $data = [
            'balance' => function ($query, $keyword) {
                $query->where('balance', 'like', '%' . $keyword . '%');
            },
            'name' => function ($query, $keyword) {
                $query->whereRelation('user','name', 'like', '%' . $keyword . '%');
            },
            'role' => function ($query, $keyword) {
                $query->whereHas('user',function($query) use($keyword){
                    $query->whereRelation('roles','name', 'like', '%' . $keyword . '%');
                });
            },
            'iban' => function ($query, $keyword) {
                $query->whereRelation('user','iban', 'like', '%' . $keyword . '%');
            }, 'bank_name' => function ($query, $keyword) {
                $query->whereRelation('user','bank_name', 'like', '%' . $keyword . '%');
            },
        ];
        return $data;
    }
}
