<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->addColumn('category', function (Product $product){
                $category = getCategoryName($product->category);
                return $category;
            })
            ->addColumn('company', function (Product $product){
                $company = getCompanyName($product->company);
                return $company;
            })
            ->addColumn('created_at', function (Product $product){
                $date = diff4Human($product->created_at);
                return $date;
            })
            ->rawColumns(['category', 'company', 'created_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
//        return $model->newQuery();
        $data = Product::select();
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
            ->setTableId('proTable')
            ->setTableAttribute('class', ['table table-success table-stripped table-hover '])
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
            Column::make('name'),
            Column::make('category'),
            Column::make('code'),
            Column::make('company'),
            Column::make('sale_price'),
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
        return 'Products_' . date('YmdHis');
    }
}
