<?php

namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdminDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
            ->rawColumns(['edit', 'delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        return $model->newQuery();
    }

    //public static function lang()
//    {
//        $langJson = [
//            'sProcessing' => trans('admin.sProcessing'),
//            'sLengthMenu' => trans('admin.sLengthMenu'),
//            'sZeroRecords' => trans('admin.sZeroRecords'),
//            'sEmptyTable' => trans('admin.sEmptyTable'),
//            'sInfo' => trans('admin.sInfo'),
//            'sInfoEmpty' => trans('admin.sInfoEmpty'),
//            'sInfoFiltered' => trans('admin.sInfoFiltered'),
//            'sInfoPostFix' => trans('admin.sInfoPostFix'),
//            'sSearch' => trans('admin.sSearch'),
//            'sUrl' => trans('admin.sUrl'),
//            'sInfoThousands' => trans('admin.sInfoThousands'),
//            'sLoadingRecords' => trans('admin.sLoadingRecords'),
//            'oPaginate' => [
//                'sFirst' => trans('admin.sFirst'),
//                'sLast' => trans('admin.sLast'),
//                'sNext' => trans('admin.sNext'),
//                'sPrevious' => trans('admin.sPrevious'),
//            ],
//            'oAria' => [
//                'sSortAscending' => trans('admin.sSortAscending'),
//                'sSortDescending' => trans('admin.sSortDescending'),
//            ],
//        ];
//        return $langJson;
//    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('admindatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1)
//                    ->buttons(
//                        Button::make('create'),
//                        Button::make('export'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    )
//                    ->buttons(
//                        Button::make(['extend' => 'create', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-plus"> New Admin </i>']),
//                        Button::make([
//                            ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"> Export CSV </i>'],
//                            ['extend' => 'excel', 'className' => 'btn btn-secondary', 'text' => '<i class="fa fa-file-excel"> Export Excel </i>'],
//                        ]),
//                        Button::make(['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"> Print </i>']),
//                        Button::make(['extend' => 'reset', 'className' => 'btn btn-warning', 'text' => '<i class="fa fa-undo"> Reset </i>']),
//                        Button::make(['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-retweet"> Reload </i>'])
//                    )
            ->parameters([
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-plus"> ' . trans('admin.new_admin') . ' </i>'],
                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"> ' . trans('admin.print') . ' </i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"> ' . trans('admin.csv') . ' </i>'],
                    ['extend' => 'excel', 'className' => 'btn btn-secondary', 'text' => '<i class="fa fa-file-excel"> ' . trans('admin.excel') . ' </i>'],
                    ['extend' => 'reset', 'className' => 'btn btn-warning', 'text' => '<i class="fa fa-undo"> ' . trans('admin.reset') . ' </i>'],
                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-retweet"> ' . trans('admin.reload') . ' </i>'],
                ],
                //'language' => ["url" => adminUrl('datatables/lang')]   // Or
                //'language' => self::lang(),  // Or
//                'language' => [
//                    'sProcessing' => trans('admin.sProcessing'),
//                    'sLengthMenu' => trans('admin.sLengthMenu'),
//                    'sZeroRecords' => trans('admin.sZeroRecords'),
//                    'sEmptyTable' => trans('admin.sEmptyTable'),
//                    'sInfo' => trans('admin.sInfo'),
//                    'sInfoEmpty' => trans('admin.sInfoEmpty'),
//                    'sInfoFiltered' => trans('admin.sInfoFiltered'),
//                    'sInfoPostFix' => trans('admin.sInfoPostFix'),
//                    'sSearch' => trans('admin.sSearch'),
//                    'sUrl' => trans('admin.sUrl'),
//                    'sInfoThousands' => trans('admin.sInfoThousands'),
//                    'sLoadingRecords' => trans('admin.sLoadingRecords'),
//                    'oPaginate' => [
//                        'sFirst' => trans('admin.sFirst'),
//                        'sLast' => trans('admin.sLast'),
//                        'sNext' => trans('admin.sNext'),
//                        'sPrevious' => trans('admin.sPrevious'),
//                    ],
//                    'oAria' => [
//                        'sSortAscending' => trans('admin.sSortAscending'),
//                        'sSortDescending' => trans('admin.sSortDescending'),
//                    ],
//                ]
                // Or
                'language' => datatablesLang(),
            ])
            ->initComplete("function () {
                            this.api().columns([0,1,2,3,4]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? val : '', true, false).draw();
                                });
                            });
                        }");
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
//        return [
//            Column::make('id'),
//            Column::make('name'),
//            Column::make('email'),
//            Column::make('created_at'),
//            Column::make('updated_at'),
//            Column::computed('edit')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center'),
//            Column::computed('delete')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center'),
//        ];
        // or
        return [
            Column::computed('id', trans('admin.admin_id'))->addClass('text-center'),
            Column::computed('name', trans('admin.admin_name'))->addClass('text-center'),
            Column::computed('email', trans('admin.admin_email'))->addClass('text-center'),
            Column::computed('created_at', trans('admin.created_at'))->addClass('text-center'),
            Column::computed('updated_at', trans('admin.updated_at'))->addClass('text-center'),
            Column::computed('edit', trans('admin.edit'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('delete', trans('admin.delete'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}
