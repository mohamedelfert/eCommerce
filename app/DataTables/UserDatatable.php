<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('edit', 'admin.users.btn.edit')
            ->addColumn('delete', 'admin.users.btn.delete')
            ->addColumn('level', 'admin.users.btn.level')
            ->rawColumns(['checkbox', 'edit', 'delete','level']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->where(function ($query){
            if (request()->has('level')){
                return $query->where('level',request('level'));
            }
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('userdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(1, 'asc')
            ->parameters([
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-plus"> ' . trans('user.new_user') . ' </i>'],
                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"> ' . trans('user.print') . ' </i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"> ' . trans('user.csv') . ' </i>'],
                    ['extend' => 'excel', 'className' => 'btn btn-secondary', 'text' => '<i class="fa fa-file-excel"> ' . trans('user.excel') . ' </i>'],
                    ['extend' => 'reset', 'className' => 'btn btn-warning', 'text' => '<i class="fa fa-undo"> ' . trans('user.reset') . ' </i>'],
                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-retweet"> ' . trans('user.reload') . ' </i>'],
                    ['text' => '<i class="fa fa-trash"> ' . trans('user.delete') . ' </i>', 'className' => 'btn btn-danger delBtn'],
                ],
                'language' => datatablesLang(),
            ])
            ->initComplete('function () {
                            this.api().columns([2,3]).every(function () {
                                var column = this;
                                var input = document.createElement("input");
                                $(input).appendTo($(column.footer()).empty())
                                .on("keyup", function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? val : "", true, false).draw();
                                });
                            });
                        }');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('checkbox', '<input type="checkbox" class="select_all" onclick="checkAll()"/>')
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->width(30)
                ->addClass('text-center'),
            Column::computed('id', trans('user.user_id'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('name', trans('user.user_name'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('email', trans('user.user_email'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('level', trans('user.level'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('created_at', trans('user.created_at'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('updated_at', trans('user.updated_at'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('edit', trans('user.edit'))
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('delete', trans('user.delete'))
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
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
        return 'User_' . date('YmdHis');
    }
}
