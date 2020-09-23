@extends('admin.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('all.sales')}}">Sales</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Sales</li>
@endsection

@section('content')
    <div class="container">
        <div class="card card-custom bg-primary-o-40">
            <div class="card-header">
                <h3 class="card-title">Sales Form</h3>
            </div>
            <!--begin::Form-->
            <div class="card-body">
                <form class="form" id="saleForm" action="" method="POST" accept-charset="utf-8">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="cusName">Customer Name*</label>
                            <input type="text" class="form-control" id="cusName" name="customer_name" value="Walk-IN"  placeholder=""/>
                        </div>
                        <div class="col-md-3">
                            <label for="invoice">Invoice*</label>
                            <input type="text" class="form-control" id="invoice" name="invoice" value="{{@$invoice}}" readonly/>
                        </div>
                        <div class="col-md-3">
                            <label for="saleMan">Sale Man*</label>
                            <input type="text" class="form-control" id="saleMan" name="sale_man"  value="Umer"/>
                        </div>
                        <div class="col-md-3">
                            <label for="dateTime">Date & Time*</label>
                            <input type="text" class="form-control" id="dateTime" name="date_time" value="{{@$dateTime}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="tabNo">Table No*</label>
                            <input type="text" class="form-control" id="tabNo" name="table_no" value="1"  placeholder="123"/>
                        </div>
                        <div class="col-md-3">
                            <label for="kotNo">K.O.T No*</label>
                            <input type="text" class="form-control" id="kotNo" name="kot_no"  value="1234"/>
                        </div>
                        <div class="col-md-3">
                            <label for="products">Product Name / Code*</label>
                            <select class="form-control select2" name="product" id="products">
                                <option selected hidden value="">Select Product</option>
                                @if(count($products) > 0)
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}} / {{$product->code}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="qty">Quantity*</label>
                            <input type="number" class="form-control" id="qty" name="qty" min="1" placeholder="1234"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <a id="addToCart" class="btn btn-success btn-block" href="javascript:void(0)">
                                <i class="fas fa-shopping-cart"></i> Add To Cart
                            </a>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label  class="col-md-6 col-form-label">Total</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="total" readonly/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="container p-5" style="border: 5px solid #543535  !important;">
                                <div class="mb-5">
                                    <h2 class="cart-heading" style="text-align: center !important;">Your Cart :)</h2>
                                </div>
                                <table id="salesCart" class="table table-dark table-hover shopping-cart-wrap text-center">
                                    <thead class="text-primary font-weight-bold">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price/Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="addRow" class="table-dark text-dark"></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label  class="col-md-6 col-form-label">Service 8%</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="service" value="" id="example-text-input"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-6 col-form-label">GST 16%</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="gst" value="" id="example-text-input"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-6 col-form-label">Discount</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="discount" name="discount" value=""
                                           />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-6 col-form-label">Grand Total</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="grandTotal" name="g_total" readonly/>
                                </div>
                            </div>
                            <input type="submit" id="savePrint" name="save" class="btn btn-primary btn-block"
                                   value="Save And Print">
                        </div>
                    </div>

                </form>
            </div>
            <!--end::Form-->
        </div>
    </div>
@endsection

@section('extra-js')
    <script type="text/javascript">
        $(document).ready(function() {
            const addCartBtn = $('#addToCart');
            const cartTableSelector = $('#salesCart');
            var saleItems = [];
            var proDetails = [];

            // Cart Section

            <!-- get product details -->
            $('#products').on('change', function (e) {
                e.preventDefault();
                var product = $(this).val();
                $.ajax({
                    url: "{{route('fetch.single.product')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {product},
                    dataType: 'json',
                    success: function (data) {
                        if(data) {
                            proDetails.push(data);
                        }
                    },
                    error: function () {
                        alert("Unable to get product!");
                    }
                });
            });

            <!-- add items to cart -->
            addCartBtn.on('click', function () {
                const productSelector = $('select[name=product]');
                const qtySelector = $('input[name=qty]');
                if (productSelector.val().length === 0 || qtySelector.val().length === 0) {
                    alert('Please Select Product/QTY :)')
                }else {
                    if(proDetails.length > 0) {
                        for (let i = 0; i < proDetails.length; i++) {
                            const productId = proDetails[i]['id'];
                            const productName = proDetails[i]['name'];
                            const productPrice = proDetails[i]['sale_price'];
                            const productQty = qtySelector.val();
                            var formData = {
                                'proId' : productId,
                                'product': productName,
                                'qty': productQty,
                                'price': productPrice,
                                'total_price': productPrice * productQty,
                            };
                        }
                    }
                }

                saleItems.push(formData);

                //  reset fields
                productSelector.val('').change();
                qtySelector.val('');

                renderItems(saleItems);
            });

            const renderItems = function renderItems(saleItems) {
                var total = grandTotal = 0;
                const totalSelector = $('input[name=total]');
                const serviceSelector = $('input[name=service]');
                const gstSelector = $('input[name=gst]');
                const grandSelector = $('input[name=g_total]');
                if(saleItems.length > 0) {
                    for (let i = 0; i < saleItems.length; i++) {
                        total += saleItems[i].total_price;
                        $('#salesCart').append('<tr id="addRow' + (i + 1) + '"></tr>');
                        $('#addRow' + (i + 1)).html(
                            "<td>" + saleItems[i].product + "</td>" +
                            "<td>" + saleItems[i].price + "</td>" +
                            "<td>" + saleItems[i].qty + "</td>" +
                            "<td>" + saleItems[i].total_price + "</td>" +
                            "<td><a href='javascript:void(0)' class='btn btn-danger delete'  data-item-no="+i+">Delete</a></td>"
                        );
                    }
                } else {
                    $('#salesCart tbody').html('');
                }
                // value assign fields
                grandTotal = total + (total * 0.08) + (total * 0.16);
                totalSelector.val(total);
                serviceSelector.val((total * 0.08).toFixed(0));
                gstSelector.val((total * 0.16).toFixed(0));
                grandSelector.val(grandTotal.toFixed(0));
            };

            <!-- delete cart items -->
            cartTableSelector.on('click', '.delete', function () {
                const selectedItem  = $(this).data('item-no');
                saleItems.splice(selectedItem, 1);
                renderItems(saleItems);
            });

            <!-- discount from grand total -->
            $('#discount').keyup(function () {
                const disc = $(this).val();
                const gTotal = $('#grandTotal');
                const changeGrandTotal = gTotal.val() - disc;
                gTotal.val(changeGrandTotal);
            });

            // print table
            // $('#savePrint').click(function() {
            //     var divToPrint=document.getElementById("print-table");
            //     newWin= window.open("");
            //     newWin.document.write(divToPrint.outerHTML);
            //     newWin.print();
            //     newWin.close();
            // });

            <!-- data insert into database -->
            $('#saleForm').on('submit', function (e) {
                e.preventDefault();
                var customerName = $('input[name=customer_name]').val();
                var invoice = $('input[name=invoice]').val();
                var saleMan = $('input[name=sale_man]').val();
                var dateTime = $('input[name=date_time]').val();
                var tableNo = $('input[name=table_no]').val();
                var kotNo = $('input[name=kot_no]').val();
                var total = $('input[name=total]').val();
                var service = $('input[name=service]').val();
                var gst = $('input[name=gst]').val();
                var discount = $('input[name=discount]').val();
                var gTotal = $('input[name=g_total]').val();

                $.ajax({
                    url: "{{route('store.sales')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        saleItems,
                        customerName,
                        invoice,
                        saleMan,
                        dateTime,
                        tableNo,
                        kotNo,
                        total,
                        service,
                        gst,
                        discount,
                        gTotal
                    },
                    dataType: 'json',
                    success: function (response) {
                        if(response.success) {
                            saleItems = [];
                            renderItems(saleItems);
                            document.getElementById("saleForm").reset();
                            toastr.success('Your record store successfully:)');
                        }
                    },
                    error: function () {
                        alert("Unable to add Sales!", 'Success');
                    }
                });
            });
        });
    </script>
@endsection
