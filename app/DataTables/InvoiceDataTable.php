<?php

namespace App\DataTables;

use App\Models\Invoices;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InvoiceDataTable extends DataTable
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
            ->addColumn('checkbox', 'admin.invoice.checkbox')
            ->addColumn('العمليات', 'admin.invoice.actions')
            ->rawColumns(['checkbox','العمليات']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Governorate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoices $model)
    {
         //this is the default if the relationship doesn't exist
        
        return $model->with(['office','user','driver'])->newQuery();
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
                    'text'      => '<i class="fa fa-plus"> </i> أضافة فاتوره جديدة'  ,
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

                'name'              => 'id',
                'data'              => 'id',
                'title'             => 'رقم االفاتوره',

            ],
            [

                'name'              => 'office.name',
                'data'              => 'office.name',
                'title'             => 'اسم المكتب',

            ],

            [

                'name'              => 'invoice_Date',
                'data'              => 'invoice_Date',
                'title'             => 'تاريخ الفاتوره',

            ],
           
            
            [

                'name'              => 'driver.name',
                'data'              => 'driver.name',
                'title'             => 'اسم الكابتن',

            ],

            [

                'name'              => 'username',
                'data'              => 'username',
                'title'             =>  'اسم العميل',

            ],
            [

                'name'              => 'fromplace',
                'data'              => 'fromplace',
                'title'             => 'محطة الوصول',

            ],
            [

                'name'              => 'toplace',
                'data'              => 'toplace',
                'title'             => 'محطة الانطلاق',

            ],
            [

                'name'              => 'Status',
                'data'              => 'Status',
                'title'             => 'حالة الفاتوره',

            ],
            [

                'name'              => 'Total',
                'data'              => 'Total',
                'title'             => 'الاجمالى الفاتوره',

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
        return 'Report_' . date('YmdHis');
    }
}
