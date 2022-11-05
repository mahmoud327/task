<?php

namespace App\DataTables;

use App\Models\Area;
use App\Models\Bill;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BillDataTable extends DataTable
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
            ->addColumn('checkbox', 'admin.bills.checkbox')
            ->addColumn('العمليات', 'admin.bills.actions')
            ->rawColumns(['checkbox','العمليات','delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Governorate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bill $model)
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

                    'text'      => '<i class="fa fa-plus"> </i> أضافة بوليصه جديدة'  ,
                    'className' => 'btn btn-info',
                    'action'    => "function(){

                        window.location.href = '" . \URL::current() . "/create ';

                    }"

                ],

                [ 'extend' => 'reload', 'className' => 'btn btn-primary' , 'text' => '<i class="fa fa-retweet">' ],




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

                'name'              => 'consignee',
                'data'              => 'consignee',
                'title'             => 'اسم المرسل اليه',

            ],
            [

                'name'              => 'bill_code',
                'data'              => 'bill_code',
                'title'             => 'كود البوليصه',

            ],
            [

                'name'              => 'number_of_pieces',
                'data'              => 'number_of_pieces',
                'title'             => 'عدد القطع',

            ],
            [

                'name'              => 'phone',
                'data'              => 'phone',
                'title'             => 'رقم التليفون',

            ],
            [

                'name'              => 'amount_inclusive_expenses',
                'data'              => 'amount_inclusive_expenses',
                'title'             => 'المبلغ شاملا المصاريف
                ',

            ],
            [

                'name'              => 'total',
                'data'              => 'total',
                'title'             => 'الصافى',

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

}
