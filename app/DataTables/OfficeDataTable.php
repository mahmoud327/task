<?php

namespace App\DataTables;

use App\Models\Office;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OfficeDataTable extends DataTable
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
            ->addColumn('checkbox', 'admin.offices.checkbox')
            ->addColumn('العمليات', 'admin.offices.actions')
            ->rawColumns(['العمليات'])
            ->rawColumns(['checkbox','العمليات','delete']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Office $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Office $model)
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
        ->parameters([
            'dom'          => 'Blfrtip',
            'buttons'      => [

                [
                    'text'      => '<i class="fa fa-plus"> </i> أضافة مكتب جديد'  ,
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
                    'title'             => 'الاسم',

                ],
                [

                    'name'              => 'email',
                    'data'              => 'email',
                    'title'             => 'البريد',

                ],
                [

                    'name'              => 'phone',
                    'data'              => 'phone',
                    'title'             => 'الهاتف',

                ],
                [

                    'name'              => 'address',
                    'data'              => 'address',
                    'title'             => 'العنوان',

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
        return 'Office_' . date('YmdHis');
    }
}
