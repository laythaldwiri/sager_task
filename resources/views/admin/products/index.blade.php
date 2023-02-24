@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- =========================================================== --}}
            {{-- ====================== Sweet Alert ======================== --}}
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
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>Products</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> Products
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.products-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i> Add New </a>
                    <a href="{{ route('super_admin.products-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
                            class="mdi mdi-delete"></i> Archive </a>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;"></div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center">#Ref</th>
                                <th style="text-align: center">Name</th>
                                <th style="text-align: center">Price</th>
                                <th style="text-align: center">Quantity</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> Date/Time</th>
                                <th style="text-align: center">Created By</th>
                                <th style="text-align: center">Image</th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($products) && $products->count() > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td style="text-align: center">{!! isset($product->id) ? $product->id : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($product->name) ? $product->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($product->price) ? $product->price : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($product->quantity) ? $product->quantity : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td>
                                            @if (isset($product->status))
                                                @if ($product->status == 'Active')
                                                    <span style="color: Green">{{ $product->status }}</span>
                                                @else
                                                    <span style="color: red">{{ $product->status }}</span>
                                                @endif
                                                <a href="{{ route('super_admin.products-activeInactiveSingle', [isset($product->id) ? $product->id : '----------']) }}" class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i class="mdi mdi-stop"></i></a>
                                            @else
                                                <span style='color:blue;'>------</span>
                                            @endif
                                        </td>
                                        <td>{!! isset($product->created_at) ? $product->created_at . '<br> (' . $product->created_at->diffForHumans() . ')' : "<span style='color:blue;'>----------</span>" !!}</td>
                                        <td style="text-align: center">{!! isset($product->user->name) ? $product->user->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        @if (isset($product->image) && $product->image && file_exists($product->image))
                                            <td>
                                                <img src="{{ asset($product->image) }}" width="70" height="70" style="border-radius: 10px; border:solid 1px black;">
                                            </td>
                                        @else
                                            <td>
                                                <img src="{{ asset('images_default/default.png') }}" width="90" height="70" style="border-radius: 10px; border:solid 2px black;">
                                            </td>
                                        @endif
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.products-show', $product->id) }}" class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('super_admin.products-edit', $product->id) }}" class="mb-1 btn btn-sm btn-success"><i class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.products-deleteOneQuantity', [isset($product->id) ? $product->id : '----------']) }}" class="process mb-1 btn btn-sm btn-warning" title="Delete One Quantity"><i class="mdi mdi-minus-box"></i></a>
                                            <a href="{{ route('super_admin.products-softDelete', [isset($product->id) ? $product->id : -1]) }}" class="confirm mb-1 btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endsection

        @section('admin_javascript')
            <script>
                jQuery(document).ready(function() {
                    jQuery('#hoverable-data-table').DataTable({
                        "aLengthMenu": [
                            [20, 30, 50, 75, -1],
                            [20, 30, 50, 75, "All"],
                        ],
                        "pageLength": 50,
                        "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                        "order": [
                            [0, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
