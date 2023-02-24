@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">

                {{-- ============================================== --}}
                {{-- ================== Header ==================== --}}
                {{-- ============================================== --}}
                <div class="col-md-12">
                    <h1>Edit customers</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.customers-index') }}">
                                    <i class="fas fa-users-cog"></i> All Users
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>

                {{-- ============================================== --}}
                {{-- =================== Body ===================== --}}
                {{-- ============================================== --}}
                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                                    </div>
                                    <div class="card-body">
                                        <form id="createForm" action="{{ route('super_admin.customers-update', isset($customer->id) ? $customer->id : -1) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                           
                                                {{-- Name --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">Name :
                                                        <strong class="text-danger"> * @error('name') - {{ $message }} @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Name"
                                                            value="{!! isset($customer->name) ? $customer->name : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Email --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">Email :
                                                        <strong class="text-danger"> * @error('email') - {{ $message }} @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Email"
                                                            value="{!! isset($customer->email) ? $customer->email : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Password --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">Password :
                                                        <strong class="text-danger"> @error('password') - {{ $message }} @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="password" name="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Password">
                                                    </div>
                                                </div>

                                                {{-- Re-type Password --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="Rpassword">Re-type Password
                                                        <strong class="text-danger"> @error('password_confirmation') - {{ $message }} @enderror</strong>
                                                    </label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" @error('password_confirmation') is-invalid @enderror
                                                        id="validationServer01" placeholder="Re-type Password" />
                                                </div>

                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">Status :
                                                        <strong class="text-danger"> * @error('status') {{ $message }} @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="status" class="custom-select my-1 mr-sm-2 @error('status') is-invalid @enderror" id="inlineFormCustomSelectPref">
                                                            <option value="" selected>Select Status...</option>
                                                            <option value="1" @if (isset($customer->status) && $customer->status == 'Active') selected @endif>Active</option>
                                                            <option value="2" @if (isset($customer->status) && $customer->status == 'Inactive') selected @endif>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Button --}}
                                                <div class="col-md-12 mb-3 mt-5">
                                                    <button class="mdi btn btn-primary" type="submit"><span class="mdi mdi-plus"></span>Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $("#selectUser").change(function() {
            var val = $(this).val();
            if (val == "2") {
                $("#storesForm").css("display", "block");

            } else {
                $("#storesForm").css("display", "none");
            }
            $("#text").val(val);
            // console.log($("text").val(val);)
        });
    </script>
    <script>
        window.onload = function() {
            var val = $("#selectUser").val();
            if (val == "2") {
                $("#storesForm").css("display", "block");

            } else {
                $("#storesForm").css("display", "none");
            }
            $("#text").val(val);
        };
    </script>
@endsection
