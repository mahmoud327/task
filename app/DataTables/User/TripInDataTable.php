<?php

namespace App\DataTables\User;

use App\Models\Trip;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TripInDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $_param;
    protected $i = 0;
    public function __construct($id)
    {
        $id = (int)$id;
        $this->_param = $id;
    }

    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('العمليات', 'user.insidetrip.actions')
            ->rawColumns(['العمليات']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Trip $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function query(Trip $model)
    // {

    //     return $model->newQuery();
    // }

    public function query(Trip $model)
    {
        return $model->where('user_id', $this->_param)->where('types','in')->with(['office', 'driver'])->newQuery();
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
                    'text'      => '<i class="fa fa-plus"> </i> أضافة رحلة جديد'  ,
                    'className' => 'btn btn-info',
                    'action'    => "function(){

                        window.location.href = '" . \URL::current() . "/create ';

                    }"

                ],

                    ['extend' => 'print', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file"></i> '.trans('csv')],
                    ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> '.trans('excel')],
                    ['extend' => 'reload', 'className' => 'btn btn-default', 'text' => '<i class="fa fa-refresh"></i>'],

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

                    'name'              => 'id',
                    'data'              => 'id',
                    'title'             => '#',

                ],
            
                [

                    'name'              => 'client_name',
                    'data'              => 'client_name',
                    'title'             => 'اسم العميل',

                ],
                [

                    'name'              => 'phone',
                    'data'              => 'phone',
                    'title'             => 'رقم التليفون',

                ],
                [

                    'name'              => 'driver.name',
                    'data'              => 'driver.name',
                    'title'             => 'اسم الكابتن',

                ],
                [

                    'name'              => 'price',
                    'data'              => 'price',
                    'title'             => 'سعر الرحله',

                ],
                [

                    'name'              => 'status',
                    'data'              => 'status',
                    'title'             => 'حالة الرحلة',
    
                ],
                [

                    'name'              => 'العمليات',
                    'data'              => 'العمليات',
                    'title'             => 'العمليات',
                    'exportable'        => false,
                    'printable'         => false,
                    'orderable'         => true,
                    'searchable'        => false,
                ],
                // [

                //     'name'              => '#',
                //     'data'              => '#',
                //     'title'             => '#',
                //     'exportable'        => false,
                //     'printable'         => false,
                //     'orderable'         => false,
                //     'searchable'        => false,
                // ],
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User\Trip_' . date('YmdHis');
    }
}
