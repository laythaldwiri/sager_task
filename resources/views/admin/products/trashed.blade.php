@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content">
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
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1><i class="mdi mdi-delete"></i> Archived products</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi  mdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.products-index') }}">
                                    <i class="mdi  mdi-home"></i> All products
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-delete"></i> Archived
                                products
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                    {{-- <h2 style="color:white;"><i class="mdi mdi-star mdi-spin"></i> طلبات سحب الرصيد : </h2> --}}
                </div>
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
                                <th style="text-align: center">Image</th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($products) && $products->count() > 0)
                                @foreach ($products as $index => $product)
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
                                            @else
                                                <span style='color:blue;'>------</span>
                                            @endif
                                        </td>
                                        <td>{!! isset($product->created_at) ? $product->created_at . '<br> (' . $product->created_at->diffForHumans() . ')' : "<span style='color:blue;'>----------</span>" !!}</td>
                                        @if (isset($product->image) && $product->image && file_exists($product->image))
                                            <td>
                                                <img src="{{ asset($product->image) }}" width="70" height="70" style="border-radius: 10px; border:solid 1px black;">
                                            </td>
                                        @else
                                            <td>
                                                <img src="{{ asset('images_default/default.png') }}" width="90" height="70" style="border-radius: 10px; border:solid 2px black;">
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('super_admin.products-softDeleteRestore', [isset($product->id) ? $product->id : '----------']) }}"
                                                class="unarchive mb-1 btn btn-sm btn-success" title="Restore"><i
                                                    class="mdi mdi-redo-variant"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin_javascript')
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
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
