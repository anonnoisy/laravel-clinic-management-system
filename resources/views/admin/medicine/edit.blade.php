@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Medicine</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::medicine::index') }}">Manage Medicines</a>
    </li>
    <li class="breadcrumb-item active">Edit medicine</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Edit Medicine</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="medicine_name">Medicine name</label>
                                <input class="form-control form-control-sm mt-15" id="medicine_name" type="text" name="medicine_name" value="{{ old('medicine_name') }}" placeholder="Enter medicine name">
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="medicine_category">Category</label>
                                <select name="medicine_category" id="medicine_category" class="form-control form-control-sm pb-2">
                                    <option>Select medicine category</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="price">Price</label>
                                <input class="form-control form-control-sm mt-15" id="price" type="price" name="price" value="{{ old('price') }}" placeholder="Enter price">
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="total_quantity">Total quantity</label>
                                <input type="text" id="total_quantity" placeholder="Enter quantity" name="total_quantity" value="{{ old('total_quantity') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="manufacturing_company">Manufacturing company</label>
                                <input type="text" id="manufacturing_company" placeholder="Enter manufacturing company" name="manufacturing_company" value="{{ old('manufacturing_company') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="description">Description</label>
                                <textarea id="description" placeholder="Enter description" name="description" class="form-control form-control-sm pb-2" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save medicine</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
