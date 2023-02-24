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

    {{-- ============================================== --}}
    {{-- ================== Header ==================== --}}
    {{-- ============================================== --}}
    <div class="tab-pane fade show active"  role="tabpanel" aria-labelledby="timeline-tab">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1><i class="mdi mdi-information"></i> Product Information</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('super_admin.dashboard') }}">
                                <i class="mdi mdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('super_admin.products-index') }}">
                                <i class="mdi mdi-format-list-bulleted"></i> All Products
                            </a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> Product
                            Information
                        </li>
                    </ol>
                </nav>
            </div>
            <div>








            </div>
        </div>

        <div class="bg-white border rounded">
            <div class="row no-gutters">
                <div class="col-lg-12 col-xl-12">
                    <div class="profile-content-right py-5">
                        {{-- ================================================================================================= --}}
                        {{-- ================================ Tabs Titles (Headers) Section ================================== --}}
                        {{-- ================================================================================================= --}}
                        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                            {{-- Main Info --}}
                            <li class="nav-item">
                                <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#tab_1" role="tab"
                                    aria-controls="timeline" aria-selected="true"> Product Info</a>
                            </li>
                        </ul>

                        {{-- ================================================================================================= --}}
                        {{-- ================================= Tabs Details (Bodies) Section ================================= --}}
                        {{-- ================================================================================================= --}}
                        <div class="tab-content px-3 px-xl-5" id="myTabContent">
                            {{-- ============================================================================== --}}
                            {{-- ================================= Tab 1 Body ================================= --}}
                            {{-- ============================================================================== --}}

                            {{-- ============================================== --}}
                            {{-- ============= All Error Messages ============= --}}
                            {{-- ============================================== --}}
                            <div class="mt-3">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <h3>Please correct the following errors : </h3>
                                        <hr>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>- {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            {{-- ============================================== --}}
                            {{-- ============== Main Information ============== --}}
                            {{-- ============================================== --}}
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                aria-labelledby="timeline-tab">
                                <div class="media mt-3 profile-timeline-media">
                                    <div class="media-body">
                                        <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> Main Information :
                                        </h3>

                                        <table id="hoverable-data-table" class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <span style="color:blue;">
                                                            @if (isset($product->image) && $product->getRawOriginal('image') && file_exists($product->getRawOriginal('image')))
                                                                <img src="{{ asset($product->image) }}" width="100" height="100" style="border-radius: 10px; border:solid 1px black;">
                                                            @else
                                                                <img src="{{ asset('images_default/default.png') }}" width="100" height="100" style="border-radius: 10px; border:solid 1px black;">
                                                            @endif
                                                        </span>
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <th>Name : <span style="color:blue;">{{ isset($product->name) ? $product->name : '------' }}</span></th>
                                                    <th>Price : <span style="color:blue;">{{ isset($product->price) ? $product->price : '------' }}</span></th>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Quantity : <span style="color:blue;">{{ isset($product->quantity) ? $product->quantity : '------' }}</span></th>
                                                    <th>Price : <span style="color:blue;">{{ isset($product->price) ? $product->price : '------' }}</span></th>
                                                </tr>
                                               
                                                <tr>
                                                    <th>Quantity : <span style="color:blue;">{{ isset($product->quantity) ? $product->quantity : '------' }}</span></th>
                                                    <th>Status: <span style="color:blue;">{{ isset($product->status) ? $product->status : '------' }}</span> </th>
                                                </tr>

                                                <tr>
                                                    <th><i class="mdi mdi-clock-outline mdi-spin"></i> Addition Time : <span style="color:blue;">{!! isset($product->created_at) ? date('h:i A', strtotime($product->created_at)) : '<span style="color:blue;">----------</span>' !!}</span></th>
                                                    <th><i class="mdi mdi-clock-outline mdi-spin"></i> Addition Date : <span style="color:blue;">{!! isset($product->created_at) ? date('Y / F (m) / d', strtotime($product->created_at)) : '<span style="color:blue;">----------</span>' !!}</span></th>
                                                </tr>

                                                {{-- Categories --}}
                                                <tr>
                                                    <th colspan="2">Categories :
                                                        @if (isset($product->categories) && $product->categories->count() > 0)
                                                            @foreach ($product->categories as $key => $category)
                                                                @if ($key > 0)
                                                                    ||
                                                                @endif
                                                                (<span style="color:blue;">{!! isset($category->name) ? $category->name : '<span style="color:red;">Undefined</span>' !!}</span>)
                                                            @endforeach
                                                        @endif
                                                    </th>
                                                </tr>

                                                {{-- Description --}}
                                                <tr>
                                                    <th colspan="2">
                                                        <div style="border:solid 1px black; border-radius:10px; padding:10px;">
                                                            Description : <br>
                                                            <hr>
                                                            <span style="color:blue;">{!! isset($product->description) ? $product->description : '<span style="color:blue;">----------</span>' !!}</span>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ============================================================================== --}}
    {{-- ========================== Product Images Tab Body =========================== --}}
    {{-- ============================================================================== --}}

@endsection

@section('admin_javascript')
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table_1').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                "order": [
                    [2, "desc"]
                ]
            });
            jQuery('#hoverable-data-table_2').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                "order": [
                    [2, "desc"]
                ]
            });
        });
    </script>
    <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
@endsection
