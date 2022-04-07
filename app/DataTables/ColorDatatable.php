<?php

namespace App\DataTables;

use App\Models\Color;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ColorDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.colors.btn.checkbox')
            ->addColumn('color', 'admin.colors.btn.color')
            ->addColumn('edit', 'admin.colors.btn.edit')
            ->addColumn('delete', 'admin.colors.btn.delete')
            ->rawColumns(['checkbox', 'color', 'edit', 'delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Color $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Color $model)
    {
        return $model->newQuery();
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
                    ['extend' => 'create', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-plus"> ' . trans('admin.new_color') . ' </i>'],
                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"> ' . trans('admin.print') . ' </i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"> ' . trans('admin.csv') . ' </i>'],
                    ['extend' => 'excel', 'className' => 'btn btn-secondary', 'text' => '<i class="fa fa-file-excel"> ' . trans('admin.excel') . ' </i>'],
                    ['extend' => 'reset', 'className' => 'btn btn-warning', 'text' => '<i class="fa fa-undo"> ' . trans('admin.reset') . ' </i>'],
                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-retweet"> ' . trans('admin.reload') . ' </i>'],
                    ['text' => '<i class="fa fa-trash"> ' . trans('admin.delete') . ' </i>', 'className' => 'btn btn-danger delBtn'],
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
            Column::computed('id', 'ID')
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('name_ar', trans('admin.name_ar'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('name_en', trans('admin.name_en'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('color', trans('admin.color'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('created_at', trans('admin.created_at'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('updated_at', trans('admin.updated_at'))
                ->exportable(true)
                ->searchable(true)
                ->printable(true)
                ->orderable(true)
                ->addClass('text-center'),
            Column::computed('edit', trans('admin.edit'))
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('delete', trans('admin.delete'))
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
        return 'Color_' . date('YmdHis');
    }
}
