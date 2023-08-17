<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\Calls\Phones;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PhonesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    // protected $actions = ['print', 'excel', 'myCustomAction'];

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($user) {
            $dataValue = $user->id;
            return '<button class="btn btn-sm btn-secondary showJob"  value="'.$dataValue.'">View</button>';
        });
        // ->setRowId('id');
    }

    public function myCustomAction()
    {
        return "Yes";
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Phones $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('phones-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->ajax('')
                    // ->addAction(['width' => '40px'])
                    ->parameters(['button' => ['edit']])
                    // ->parameters($this->getBuilderParameters())
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->name('id')->data('id'),
            Column::make('saicomUsername'),
            // Column::make('site'),
            Column::make('displayName'),
            Column::make('extension'),
            // Column::make('active')->title('Act'),
            // Column::make('venture')->title('VT'),
            // Column::make('phoneCategory')->title('Categ'),
            // Column::make('employment')->title('Emp'),
            // Column::make('venue'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            // Column::make('company'),
            // Column::make('assigned_date'),
            // Column::make('removed_date'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Phones_' . date('YmdHis');
    }
}
