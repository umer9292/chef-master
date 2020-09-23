@extends('admin.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('all.products')}}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Product</li>
@endsection

@section('content')
    @include('admin.extras.modal')
    <div class="container">
        <div class="card card-custom bg-primary-o-40">
            <div class="card-header">
                <h3 class="card-title">Product Form</h3>
            </div>
            <!--begin::Form-->
            <div class="card-body">
                <form class="form" action="{{route('store.product')}}" method="POST" accept-charset="utf-8">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="categories">Category*</label>
                            <select class="form-control select2" name="category" id="categories">
                                <option selected hidden>Select Category</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:void(0)" class="add-category-btn btn btn-danger" style="padding: 2px 8px 2px 8px !important;margin-top: 30px;"> + </a>
                        </div>

                        <div class="col-md-5">
                            <label for="companies">Company*</label>
                            <select class="form-control select2" name="company" id="companies">
                                <option selected hidden>Select Product Company</option>
                                @if(count($companies) > 0)
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:void(0)" class="add-company-btn btn btn-danger" style="padding: 2px 8px 2px 8px !important;margin-top: 30px;"> + </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="name">Product Name*</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder=""/>
                        </div>
                        <div class="col-md-4">
                            <label for="code">Product Code*</label>
                            <input type="number" class="form-control" id="code" name="code"  placeholder="0000"/>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Sale Price*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PKR</span>
                                        <span class="input-group-text">0.00</span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="price" aria-label="Amount (to the nearest rupees)">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="submit" name="save" class="btn btn-primary" value="Save +">
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </form>
            </div>
            <!--end::Form-->
        </div>
    </div>
@endsection

@section('extra-js')
    <script type="text/javascript">
        $(document).ready(function() {
            const addCategoryBtn = $('.add-category-btn');
            const categoryModal = $('.category-modal');
            const categoryForm = $('#categoryForm');
            const addCompanyBtn = $('.add-company-btn');
            const companyModal = $('.company-modal');
            const companyForm = $('#companyForm');

            // create new category
            addCategoryBtn.on('click', function () {
                categoryModal.modal();
            });
            categoryForm.on('submit', function (e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: "{{route('store.category')}}",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.products) {
                            let result = data.products;
                            $("#categories").html('');
                            for(let i = 0; i < result.length; i++) {
                                $("#categories").append(
                                    "<option value=" + result[i].id + ">" + result[i].name + "</option>"
                                );
                            }
                            categoryModal.modal('hide');
                            document.getElementById("categoryForm").reset();
                        }
                    },
                    error: function () {
                        alert("Unable to add product!");
                    }
                });
            });

            // create new company
            addCompanyBtn.on('click', function () {
                companyModal.modal();
            });
            companyForm.on('submit', function (e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: "{{route('store.company')}}",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.locations) {
                            let result = data.locations;
                            $("#companies").html('');
                            for(let i = 0; i < result.length; i++) {
                                $("#companies").append(
                                    "<option value=" + result[i].id + ">" + result[i].name + "</option>"
                                );
                            }
                            companyModal.modal('hide');
                            document.getElementById("companyForm").reset();
                        }
                    },
                    error: function () {
                        alert("Unable to create new company!");
                    }
                });
            });
        });
    </script>
@endsection
