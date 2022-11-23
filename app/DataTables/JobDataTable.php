<?php

namespace App\DataTables;

use App\Models\Jobs;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JobDataTable extends DataTable
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
            ->eloquent($query->with('user', 'company', 'subcategory'))
            ->addIndexColumn()
            ->addColumn('company', function ($job) {
                return $job->company->name ?? "N/A";
            })
            ->addColumn('created_at', function ($job) {
                return $job->created_at->diffForHumans();
            })
            ->editColumn('user.name', function ($job) {
                return $job->user->name ?? "N/A";
            })
            ->addColumn('action', function ($job) {
                return view('backend.jobs.action-job', compact('job'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Job $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Jobs $model)
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
            ->setTableId('job-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('DT_RowIndex')->title('SL')->searchable(false)->orderable(false),
            Column::make('name'),
            Column::make('user.name')->title('User'),
            Column::make('subcategory.name')->title('Subcategory'),
            Column::make('phone')->title('Phone'),
            Column::computed('company')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('status')->title('Status'),
            Column::computed('created_at'),
            Column::computed('action')
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
        return 'Job_' . date('YmdHis');
    }
}
