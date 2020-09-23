<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\DataTables\ProductsDataTable;
use App\DataTables\ProductsDataTableEditor;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.pro-table');
    }

    public function store(ProductsDataTableEditor $editor)
    {
        return $editor->process(request());
    }

    public function createProduct()
    {
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.products.create-product', compact('categories', 'companies'));
    }

    public function storeCategory(Request $request)
    {
        try{
            if ($request->ajax()){
                $response['success'] = false;
                $categpry = new Category();
                if($categpry) {
                    $categpry->name = $request->name;
                    $categpry->save();

                    $response['success'] = true;
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $categories = Category::all();
        return response(['categories'=>$categories]);
    }

    public function storeCompany(Request $request)
    {
        try{
            if ($request->ajax()){
                $response['success'] = false;
                $company = new Company();
                if($company) {
                    $company->name = $request->name;
                    $company->save();

                    $response['success'] = true;
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $companies = Company::all();
        return response(['companies'=> $companies]);
    }

    public function storeProduct(Request $request)
    {
        try{
//            dd($request->all());
            $product = new Product();

            if($product) {
                $product->category = $request->category;
                $product->company = $request->company;
                $product->name = $request->name;
                $product->code = $request->code;
                $product->sale_price = $request->price;
                $product->save();
                Toastr::success('Product Successfully Added.', 'Success', ["positionClass" => "toast-top-right"]);

                return back();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
