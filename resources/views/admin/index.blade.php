@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div>
        @if (session()->has('success'))
            <script>
                swal("Great Job !!!", "{!! Session::get('success') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif
        @if (session()->has('danger'))
            <script>
                swal("Oops !!!", "{!! Session::get('danger') !!}", "error", {
                    button: "Close",
                });
            </script>
        @endif
    </div>

    <div class="row">
        {{-- Products --}}
        <div class="col-xl-4 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                
                                <h2 class="mb-1">
                                    ( {{ isset($public_all_products) ? $public_all_products->count() : 0 }} )
                                </h2>
                                <h5 class="mb-2">
                                    <a href="{{route('super_admin.products-index')}}" style="color:blue;">All Products</a>
                                </h5>
                            </div>
                            <div class="col-md-6 p-2 border">
                                <h4 class="mb-1" style="color: black;">(
                                    {{ isset($public_active_products) ? $public_active_products->count() : 0 }} )</h4>
                                <h6 style="color: green;">Active</h6>
                            </div>
                            <div class="col-md-6 p-2 border">
                                <h4 class="mb-1" style="color: black;">(
                                    {{ isset($public_inactive_products) ? $public_inactive_products->count() : 0 }} )</h4>
                                <h6 style="color: red;">Inactive</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        {{-- Categories --}}
        <div class="col-xl-4 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($public_all_categories) ? $public_all_categories->count() : 0 }} )
                                </h2>
                                <h5 class="mb-2">
                                    <a href="{{route('super_admin.categories-index')}}" style="color:blue;">All Categories</a>
                                </h5>
                            </div>
                            <div class="col-md-6 p-2 border">
                                <h4 class="mb-1" style="color: black;">(
                                    {{ isset($public_active_categories) ? $public_active_categories->count() : 0 }} )</h4>
                                <h6 style="color: green;">Active</h6>
                            </div>
                            <div class="col-md-6 p-2 border">
                                <h4 class="mb-1" style="color: black;">(
                                    {{ isset($public_inactive_categories) ? $public_inactive_categories->count() : 0 }} )</h4>
                                <h6 style="color: red;">Inactive</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        {{-- Customers --}}
        <div class="col-xl-4 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($public_all_customers) ? $public_all_customers->count() : 0 }} )
                                </h2>
                                <h5 class="mb-2">
                                    <a href="{{route('super_admin.customers-index')}}" style="color:blue;">All Customers</a>
                                </h5>
                            </div>
                            <div class="col-md-6 p-2 border">
                                <h4 class="mb-1" style="color: black;">(
                                    {{ isset($public_active_customers) ? $public_active_customers->count() : 0 }} )</h4>
                                <h6 style="color: green;">Active</h6>
                            </div>
                            <div class="col-md-6 p-2 border">
                                <h4 class="mb-1" style="color: black;">(
                                    {{ isset($public_inactive_customers) ? $public_inactive_customers->count() : 0 }} )</h4>
                                <h6 style="color: red;">Inactive</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
