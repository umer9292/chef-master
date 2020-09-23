@extends('admin.layout')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">All Sales</li>
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
                <a href="{{route('create.sales')}}" class="btn btn-outline-info"> <i class="fas
                    fa-plus"></i>&nbsp;Add New</a>

            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="table-responsive">
                    {!! $dataTable->table(['id' => 'salesTable']) !!}
                </div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            {{$dataTable->generateScripts()}}
        });
    </script>
@endsection
