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
                    <h1>Customers</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> All Users
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.customers-create') }}" class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-plus"></i> Add New </a>
                    <a href="{{ route('super_admin.customers-showSoftDelete') }}" class="mb-1 btn btn-danger"><i class="mdi mdi-delete"></i> Archive </a>
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
                                <th style="text-align: center"> #Ref </th>
                                <th style="text-align: center"> Name </th>
                                <th style="text-align: center"> Email </th>
                                <th style="text-align: center"> Status </th>                               
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> Date / Time</th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($customers) && $customers->count() > 0)
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td style="text-align: center">{!! isset($customer->id) ? $customer->id : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($customer->name) ? $customer->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($customer->email) ? $customer->email : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($customer->status) ? $customer->status : "<span style='color:red;'>Undefined</span>" !!} </td>                                        
                                        <td style="text-align: center">{!! isset($customer->created_at) ? $customer->created_at : "<span style='color:red;'>Undefined</span>" !!}</td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.customers-show', $customer->id) }}" class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a> 
                                            <a href="{{ route('super_admin.customers-edit', $customer->id) }}" class="mb-1 btn btn-sm btn-success"><i class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.customers-softDelete', [isset($customer->id) ? $customer->id : '----------']) }}" class="confirm mb-1 btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-delete"></i></a>
                                            <a href="{{ route('super_admin.customers-activeInactiveSingle', [isset($customer->id) ? $customer->id : '----------']) }}" class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i class="mdi mdi-stop"></i></a> 
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
                    [20, 30, 50, 75, "All"],
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
