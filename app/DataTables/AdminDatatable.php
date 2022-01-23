<?php

namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
            ->rawColumns(['edit','delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
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
                        'buttons'    => [
                            ['extend' => 'create', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-plus"> New Admin </i>'],
                            ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"> Print </i>'],
                            ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"> Export CSV </i>'],
                            ['extend' => 'excel', 'className' => 'btn btn-secondary', 'text' => '<i class="fa fa-file-excel"> Export Excel </i>'],
                            ['extend' => 'reset', 'className' => 'btn btn-warning', 'text' => '<i class="fa fa-undo"> Reset </i>'],
                            ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-retweet"> Reload </i>'],
                        ],
                    ]);
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
            Column::computed('id','ID')->addClass('text-center'),
            Column::computed('name','Admin Name')->addClass('text-center'),
            Column::computed('email','Admin Email')->addClass('text-center'),
            Column::computed('created_at','Created At')->addClass('text-center'),
            Column::computed('updated_at','Updated At')->addClass('text-center'),
            Column::computed('edit' ,'Edit')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('delete','Delete')
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
