<?php

namespace App\Http\Controllers;

use App\DataTables\SalesDataTable;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(SalesDataTable $dataTable)
    {
        return $dataTable->render('admin.sales.all');
    }

    public function createSales()
    {
        $products = Product::all();
        $dateTime = now()->toDateTimeString();
        $invoice = 1;
        return view('admin.sales.create', compact('products', 'dateTime', 'invoice'));
    }

    public function singleProduct(Request $request)
    {
        if ($request->ajax()) {
            $proData = Product::where('id', $request->product)->first();
            return json_encode($proData);
        }
    }

    public function storeSale(Request $request)
    {
        try{
            if ($request->ajax()) {
                $response['success'] = false;
                $saleItems = $request->saleItems;
                $proNames = [];
                $proQtys = [];

                foreach ($saleItems as $saleItem) {
                    $proNames[] = $saleItem['product'];
                    $proQtys[] = $saleItem['qty'];
                }
                    $getSaleData = [
                        'customer_name' => $request->customerName,
                        'invoice' => $request->invoice,
                        'sale_men' => $request->saleMan,
                        'date_time' => $request->dateTime,
                        'table_no' => $request->tableNo,
                        'kot_no' => $request->kotNo,
                        'products' =>  json_encode(implode(',  ' ,$proNames)),
                        'qty' => json_encode(implode(',  ' ,$proQtys)),
                        'total' => $request->total,
                        'service' => $request->service,
                        'gst' => $request->gst,
                        'discount' => $request->discount,
                        'g_total' => $request->gTotal,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];

//            dd($getSaleData, $proIds);
                    if ($getSaleData) {
                        Sale::create($getSaleData);
                        $response['success'] = true;
                    }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return response($response,  $response['success'] ? 200 : 400)
            ->header('Content-type', 'application/json');

    }
}
