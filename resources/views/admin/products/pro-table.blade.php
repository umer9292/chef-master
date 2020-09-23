@extends('admin.layout')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">All Products</li>
@endsection

@section('content')
    <div class="container">
        <div class="card card-custom gutter-b bg-primary-o-70 mt-5">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Product List
                        <span class="d-block text-muted pt-2 font-size-sm">sorting &amp; pagination remote datasource</span>
                    </h3>
                </div>

            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="table-responsive">
                    {!! $dataTable->table(['id' => 'proTable']) !!}
                </div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script type="text/javascript">
        $(document).ready(function() {
            const proTable = $('#proTable');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            {{--var editor = new $.fn.dataTable.Editor( {--}}
            {{--    ajax: "{{url(route('product'))}}",--}}
            {{--    table: "#proTable",--}}
            {{--    fields: [--}}
            {{--        {label: "Product Name:", name: "name"},--}}
            {{--        {label: "Product Code:", name: "code"},--}}
            {{--        {label: "Category:", name: "category"},--}}
            {{--        {label: "Company Name:", name: "company"},--}}
            {{--        {label: "Sale Price:", name: "price"},--}}
            {{--        {label: "Created At:", name: "created at"},--}}
            {{--    ]--}}
            {{--} );--}}



            // Activate an inline edit on click of a table cell
            // proTable.on( 'click', 'tbody td:not(:first-child)', function (e) {
            //     editor.inline( this );
            // } );

            {{$dataTable->generateScripts()}}
        });
    </script>
@endsection
