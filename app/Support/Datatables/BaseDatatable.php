<?php

namespace App\Support\Datatables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

abstract class BaseDatatable extends DataTable
{
    protected string $route = '';

    protected ?string $actionable = 'edit|delete';

    protected ?string $currentLanguage = 'ar';

    protected ?array $customData = [];

    protected bool $indexer = true;

    protected ?int $defaultOrder = 0;

    public function dataTable($query)
    {
        app()->setLocale(data_get(auth(activeGuard())->user(), 'info.language_code', 'ar'));

        $datatable = datatables()->eloquent($query)->addIndexColumn();
        $customColumns = collect($this->prepareCustomColumns());

        $customColumns->each(fn (\Closure $i, $key) => $datatable->addColumn($key, $i));

        collect($this->getFilters())
            ->each(fn (\Closure $i, $key) => $datatable->filterColumn($key, $i));

        collect($this->getOrders())
            ->each(fn (\Closure $i, $key) => $datatable->orderColumn($key, $i));

        return $datatable->rawColumns($customColumns->keys()->all());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $url = config('custom.FORCE_HTTPS') ?
            str_replace('http:', 'https:', secure_url(url()->full())) : url()->full();

        $builder = $this->builder()
                        ->setTableId('base-table')
                        ->columns($this->prepareColumns())
                        ->orderBy(1)
                        ->minifiedAjax($url)
                        ->responsive()
                        ->autoWidth(false)
                        ->postAjax($this->postAjaxAction())
                        ->parameters([
                            'initComplete' => 'function(settings, json) {datatableInitComplete(settings, json); }',
                            'drawCallback' => 'function(settings, json) {datatableDrawCallback(settings, json); }',
                        ])
                        // ->buttons(['print', 'excel'])
                        ->buttons(['excel'])
                        ->dom($this->getDomVariable())
                        ->language($this->translation())
                        ->fixedHeader(true)->lengthMenu([10, 25, 50, 100, 500])
                        ->pageLength();

        if ($this->defaultOrder !== null) {
            $builder->orderBy($this->defaultOrder, 'desc');
        }

        return $builder;
    }

    public function getIndex()
    {
        $indexColumn = $this->builder()->config->get('datatables.index_column', 'DT_RowIndex');

        return new Column([
            'data'       => $indexColumn,
            'name'       => $indexColumn,
            'title'      => '#',
            'orderable'  => false,
            'searchable' => false,
        ]);
    }

    public static function create(
        string $route,
        array $data = []
    ): static {
        $instance = new static();
        $instance->route = $route;
        $instance->customData = $data;

        return $instance;
    }

    protected function getCustomColumns(): array
    {
        return [];
    }

    protected function getFilters(): array
    {
        return [];
    }

    protected function getActions($model): array
    {
        return [];
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [];
    }

    protected function postAjaxAction(): array
    {
        // EX. 'data' => 'function(d) { d.store_id = $("#store_id").val(); }'  filter options
        return [];
    }

    protected function column(string $name, string $title, $searchable = true): Column
    {
        return Column::make($name)
                     ->title($title)
                     ->orderable(false)
                     ->searchable($searchable)
                     ->content('---');
    }

    protected function getOrders()
    {
        return [];
    }

    private function translation(): array
    {
        return [
            'sEmptyTable'     => t_('no data available in table'),
            'sInfo'           => t_('Showing').' _START_ '.t_('to').' _END_ '.t_('of').' _TOTAL_ '.t_('records'),
            'sInfoEmpty'      => t_('Showing').' 0 '.t_('to').' 0 '.t_('of').' 0 '.t_('records'),
            'sInfoFiltered'   => '('.t_('filtered').' '.t_('from').' _MAX_ '.t_('total').' '.t_('records').')',
            'sInfoPostFix'    => '',
            'sInfoThousands'  => ',',
            'sLengthMenu'     => t_('show').' _MENU_ '.t_('records'),
            'sLoadingRecords' => t_('loading...'),
            'sProcessing'     => t_('processing...'),
            'sSearch'         => t_('search').' : ',
            'sZeroRecords'    => t_('no matching records found'),
            'oPaginate'       => [
                'sFirst'    => t_('first'),
                'sLast'     => t_('last'),
                'sNext'     => <<<HTML
                      <i class="next"></i>
            HTML,
                'sPrevious' => <<<HTML
                      <i class="previous"></i>
            HTML,
            ],
        ];
    }

    private function prepareColumns()
    {
        $list = [];

        if ($this->indexer) {
            $list[] = $this->getIndex();
        }

        $list = array_merge($list, $this->getColumns());

        if ($this->actionable !== '') {
            $list[] = Column::computed('action')
                            ->title(t_('Actions'))
                            ->searchable(false)
                            ->exportable(false)
                            ->printable(false)
                            ->width(50)
                            ->addClass('text-center');
        }

        return $list;
    }

    private function prepareCustomColumns()
    {
        $customs = $this->getCustomColumns();

        if ($this->actionable !== '') {
            $customs['action'] = function ($model) {
                $allActions = array_merge(
                    $this->getActions($model),
                    $this->prepareActionsButtons($model)
                );
                $actions = implode('', $allActions);

                return "<div class='btn-group'>{$actions}</div>";
            };
        }

        return $customs;
    }

    private function prepareActionsButtons($model)
    {
        $currentActions = explode('|', $this->actionable);
        $actions = [];

        if (in_array('show', $currentActions)) {
            $route = route($this->route.'.show', $model);
            $title = t_('title show');
            $actions[] = view('components.datatable.includes.actions.show_button', compact('route', 'title'));
        }

        if (in_array('edit', $currentActions)) {
            $route = route($this->route.'.edit', $model);
            $title = t_('title edit');
            $actions[] = view('components.datatable.includes.actions.edit_button', compact('route', 'title'));
        }

        if (in_array('delete', $currentActions)) {
            $title = t_('title delete');
            $actions[] = view('components.datatable.includes.actions.delete_button', compact('model', 'title'));
        }

        return $actions;
    }

    private function getDomVariable()
    {

        return <<<HTML
             {$this->domHeaderBottom()}
             {$this->domHeaderSearch()}
             >
             {$this->domTableResponsive()}
              <'row'
             {$this->domFooterPagination()}
             {$this->domFooterTableCount()}
              >
   HTML;
    }

    protected function domHeaderBottom(): string
    {
        return "<'row'<'col-sm-6 d-flex align-items-center justify-conten-start text-bold 'B>";
    }

    protected function domHeaderSearch(): string
    {
        return "<'col-sm-6 d-flex align-items-center justify-content-end'f>";
    }

    protected function domTableResponsive(): string
    {
        return "<'table-responsive'tr>";
    }

    protected function domFooterPagination(): string
    {
        return "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start' l - i >";
    }

    protected function domFooterTableCount(): string
    {
        return " <'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>";
    }
}
