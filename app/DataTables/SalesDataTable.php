<?php

namespace App\DataTables;

use App\Sale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
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
            ->setRowId('id')
            ->addColumn('products', function (Sale $sale){
                $products = '<span class="badge badge-success">' . $sale->products . '</span>';
                return $products;
            })
            ->addColumn('qty', function (Sale $sale){
                $quantities = '<span class="badge badge-pill badge-danger">' . $sale->qty . '</span>';
                return $quantities;
            })
            ->addColumn('discount', function (Sale $sale){
                $discount = '<span class="text-success">' . (isset($sale->discount) ? $sale->discount : 'N/A') . '</span>';
                return $discount;
            })
            ->addColumn('created_at', function (Sale $sale){
                $date = '<span class="badge badge-pill badge-primary">' . diff4Human($sale->created_at) . '</span>';
                return $date;
            })
            ->rawColumns(['products', 'qty', 'discount', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Sale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sale $model)
    {
        $data = Sale::select();
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('salesTable')
            ->setTableAttribute('class', ['table table-sm table-success table-stripped table-hover '])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->buttons(
                Button::make('csv')->addClass('btn btn-outline-danger'),
                Button::make('excel')->addClass('btn btn-outline-success'),
                Button::make('print')->addClass('btn btn-outline-info'),
                Button::make('reload')->addClass('btn btn-primary')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('customer_name'),
            Column::make('date_time'),
            Column::make('sale_men'),
            Column::make('products'),
            Column::make('qty'),
            Column::make('table_no'),
            Column::make('kot_no'),
            Column::make('total'),
            Column::make('service'),
            Column::make('gst'),
            Column::make('discount'),
            Column::make('g_total'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sales_' . date('YmdHis');
    }
}
