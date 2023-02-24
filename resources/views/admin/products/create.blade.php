@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    {{-- ============================================== --}}
                    {{-- ================== Header ==================== --}}
                    {{-- ============================================== --}}
                    <h1>Add New Product</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.products-index') }}">
                                    <span class="fa fa-th"></span> products
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"> Add New product </li>
                        </ol>
                    </nav>
                </div>

                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;"></div>
                                    <div class="card-body">
                                        <form id="createForm" action="{{ route('super_admin.products-store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- Product Name --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">product Name :
                                                        <strong class="text-danger"> * @error('name_en') - {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Product Name"
                                                            value="{!! old('name') ? old('name') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Price --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">Price:
                                                        <strong class="text-danger"> * @error('price') - {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="number" name="price" step="0.001" min="1"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Product Price"
                                                            value="{!! old('price') ? old('price') : 1 !!}">
                                                    </div>
                                                </div>

                                                {{-- Quantity --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">Quantity:
                                                        <strong class="text-danger"> * @error('quantity') - {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="number" name="quantity" step="0.001" min="1"
                                                            class="form-control @error('quantity') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Product Quantity"
                                                            value="{!! old('quantity') ? old('quantity') : 1 !!}">
                                                    </div>
                                                </div>

                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">Status :
                                                        <strong class="text-danger"> * @error('status') {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="status" class="custom-select my-1 mr-sm-2 @error('status') is-invalid @enderror" id="inlineFormCustomSelectPref">
                                                            <option value="" selected>Select Status...</option>
                                                            <option value="1" @if (old('status') == 1) selected @endif @if (old('status') == null) selected @endif>Active</option>
                                                            <option value="2" @if (old('status') == 2) selected @endif>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Categories --}}
                                                <div class="col-md-12 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">Categories :
                                                        <strong class="text-danger"> * @error('category_ids.*') - {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <select name="category_ids[]" class="selectpicker" data-live-search="true" data-width="88%" multiple data-actions-box="false">
                                                            @if (isset($categories) && $categories->count() > 0)
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}" @if(is_array(old('category_ids')) && in_array($category->id, old('category_ids'))) selected @endif>
                                                                        {{ isset($category->name) ? $category->name : '------' }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Product Image --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">Product Image :
                                                        <strong class="text-danger">* @error('image') {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control" id="validationServer01">
                                                    </div>
                                                </div>

                                                {{-- Desciption --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">Description :
                                                        <strong class="text-danger"> * @error('description') - {{ $message }} @enderror </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <textarea style="width: 90% !important" name="description" maxlength="1600" class="form-control ckeditor"
                                                            rows="20">
                                                            {{ old('description') ? old('description') : null }}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                {{-- Button --}}
                                                <div class="col-md-12 mb-3">
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
@endsection

@section('admin_javascript')
{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}

<script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"],
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',

            });
        });
    </script>
    
   
@endsection
