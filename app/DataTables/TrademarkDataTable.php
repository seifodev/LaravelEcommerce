<?php

namespace App\DataTables;

use App\Model\Trademark;
use Yajra\DataTables\Services\DataTable;

class TrademarkDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'admin.trademarks.action.edit')
            ->editColumn('updated_at', function ($country) {
                return $country->updated_at ?  $country->updated_at->diffForHumans() : NULL;
            })
            ->editColumn('created_at', function ($country) {
                return $country->created_at ?  $country->created_at->diffForHumans() : NULL;
            })
            ->editColumn('logo', 'admin.trademarks.action.logo')
            ->addColumn('checkbox', 'admin.trademarks.action.checkbox')
            ->rawColumns(['action', 'checkbox', 'logo'])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Trademark $model)
    {
        return $model->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
//            ->addAction(['width' => '80px'])
//            ->parameters($this->getBuilderParameters())
            ->parameters([

                'dom'          => static::dom(),
                'lengthMenu'   => [ [10, 25, 100, -1], [10, 25, 100, 'All'] ],
                'buttons'      => static::btns(),

                'language'     => static::lang(),
//                'initComplete' => "function () {
//                            this.api().columns([0, 1, 2]).every(function () {
//                                var column = this;
//                                var input = document.createElement(\"input\");
//                                $(input).appendTo($(column.footer()).empty())
//                                .on('keyup', function () {
//                                    column.search($(this).val(), false, false, true).draw();
//                                });
//                            });
//                        }",
                'autoWidth' => false,

            ])
//            ->addCheckbox([])
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'id',
                'name' => 'id',
                'title' => '#'
            ],
            [
                'data' => 'name_ar',
                'name' => 'name_ar',
                'title' => trans('admin.table.name_ar')
            ],
            [
                'data' => 'name_en',
                'name' => 'name_en',
                'title' => trans('admin.table.name_en')
            ],
            [
                'data' => 'logo',
                'name' => 'logo',
                'title' => trans('admin.form.country_logo')
            ],
            [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => trans('admin.table.created')
            ],
            [
                'data' => 'updated_at',
                'name' => 'updated_at',
                'title' => trans('admin.table.updated')
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'title' => trans('admin.table.action'),
                'printable' => false,
                'exportable' => false,
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'checkbox',
                'name' => 'checkbox',
                'title' => '<input type="checkbox" name="checkAll" onclick="checkToggle(this)">',
                'printable' => false,
                'orderable' => false,
                'exportable' => false,
                'searchable' => false
            ],


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Country_' . date('YmdHis');
    }

    protected static function dom()
    {
        return " 
                <'top'
                    <'row mb-10'<'col-xs-12'B>>
                    <'row'<'col-md-6'l><'col-md-6'f>>
                >            
                rt
                <'bottom'
                    <'row'<'col-xs-12'p>>
                >                         
            ";
    }

    protected static function btns()
    {
        return [
            'dom' => [
                'button' => ['tag' => 'button', 'className' => 'btn']
                ],
                'buttons' => [
                    ['text' => '<i class="fa fa-plus"></i>', 'className' => 'btn btn-primary', 'action' => 'function (){window.location.href = "' . route('trademarks.create') . '"}'],
                    ['extend' => 'export', 'className' => 'btn-default', 'text' => '<i class="fa fa-download"></i> <span class="caret"></span>'],
                    ['extend' => 'print', 'className' => 'btn-default', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'reload', 'className' => 'btn-default', 'text' => '<i class="fa fa-refresh"></i>'],
                    ['extend' => 'reset', 'className' => 'btn-default', 'text' => '<i class="fa fa-undo"></i>'],
                    ['text' => '<i class="fa fa-trash"></i>', 'className' => 'btn-danger deleteAdmins'],
                ]
            ];
    }

    protected static function lang()
    {
        return [
            'decimal'         => trans('admin.datatables.decimal'),
            'emptyTable'      => trans('admin.datatables.emptyTable'),
            'info'            => trans('admin.datatables.info'),
            'infoEmpty'       => trans('admin.datatables.infoEmpty'),
            'infoFiltered'    => trans('admin.datatables.infoFiltered'),
            'infoPostFix'     => trans('admin.datatables.infoPostFix'),
            'thousands'       => trans('admin.datatables.thousands'),
            'lengthMenu'      => trans('admin.datatables.lengthMenu'),
            'loadingRecords'  => trans('admin.datatables.loadingRecords'),
            'processing'      => trans('admin.datatables.processing'),
            'search'          => trans('admin.datatables.search'),
            'zeroRecords'     => trans('admin.datatables.zeroRecords'),
            'paginate'        => [
                "first"     => trans('admin.datatables.first'),
                "last"      => trans('admin.datatables.last'),
                "next"      => trans('admin.datatables.next'),
                "previous"  => trans('admin.datatables.previous')
            ],
            "aria" => [
                "sortAscending"     => trans('admin.datatables.sortAscending'),
                "sortDescending"    => trans('admin.datatables.sortDescending')
            ]
        ];
    }
}
