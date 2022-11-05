<?php

namespace App\DataTables;

use App\Models\Driver;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DriverDataTable extends DataTable
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
            ->addColumn('checkbox', 'admin.drivers.checkbox')
            ->addColumn('العمليات', 'admin.drivers.actions')
            ->rawColumns(['checkbox','العمليات','delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Governorate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Driver $model)
    {
        return $model->with(['office'])->newQuery();
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
        ->parameters([
            'dom'          => 'Blfrtip',
            'buttons'      => [
                [
                    'text'      => '<i class="fa fa-plus"> </i> أضافة كابتن جديد'  ,
                    'className' => 'btn btn-info',
                    'action'    => "function(){

                        window.location.href = '" . \URL::current() . "/create ';

                    }"

                ],

                [ 'extend' => 'reload', 'className' => 'btn btn-primary' , 'text' => '<i class="fa fa-retweet">' ],
                [
                    'text' => '<i class="fa fa-trash"></i>', 'className' => 'btn btn-danger delBtn'],



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
        return [
            [
				'name'       => 'checkbox',
				'data'       => 'checkbox',
				'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			],
            [

                'name'              => 'id',
                'data'              => 'id',
                'title'             => '#',

            ],
            [

                'name'              => 'name',
                'data'              => 'name',
                'title'             => 'اسم الكابتن',

            ],
            [

                'name'              => 'phone',
                'data'              => 'phone',
                'title'             => 'رقم تلفون الكابتن',


             ],

             [

                'name'              => 'nationality',
                'data'              => 'nationality',
                'title'             => 'جنسيه الكابتن',


             ],

             [

                'name'              => 'office.name',
                'data'              => 'office.name',
                'title'             => 'اسم المكتب',

             ],

             [

                'name'              => 'العمليات',
                'data'              => 'العمليات',
                'title'             => 'العمليات',
                'exportable'        => false,
                'printable'         => false,
                'orderable'         => false,
                'searchable'        => false,
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
        return 'Driver_' . date('YmdHis');
    }
}
