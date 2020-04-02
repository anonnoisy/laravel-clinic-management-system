@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Medicine</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::medicine::sale::index') }}">Manage Medicine Sales</a>
    </li>
    <li class="breadcrumb-item active">Add new medicine sale</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Add New Medicine Sale</h5>
                    <form action="{{ route('admin::medicine::sale::store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="patient">Patient</label>
                                <select name="patient_id" id="patient" class="form-control form-control-sm mt-15 @error('patient_id') is-invalid @enderror">
                                    <option>Select patient</option>
                                </select>
                                @error('patient_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="medicine">Medicine</label>
                                <select name="medicine_id[]" id="medicine" class="form-control form-control-sm mt-15 @error('medicine_id') is-invalid @enderror">
                                    <option>Select medicine</option>
                                </select>
                                @error('medicine_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-5 form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" id="quantity" placeholder="Enter quantity" name="quantity[]" value="{{ old('quantity') }}" class="form-control form-control-sm mt-15 @error('quantity') is-invalid @enderror"/>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div id="template" class="row"></div>
                            <div class="col-sm-12 col-md-1 form-group">
                                <button class="mt-4" type="button" onclick="addMoreField()"><i class="fas fa-plus"></i></button>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="notes">Notes</label>
                                <textarea id="notes" placeholder="Enter notes" name="notes" class="form-control form-control-sm mt-15 @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save medicine sale</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function addMoreField() {
        let html = `
            <div class="col-sm-12 col-md-6 form-group">
                <label for="medicine">Medicine</label>
                <select name="medicine_id[]" id="medicine" class="form-control form-control-sm mt-15 @error('medicine_id') is-invalid @enderror">
                    <option>Select medicine</option>
                </select>
                @error('medicine_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-12 col-md-5 form-group">
                <label for="quantity">Quantity</label>
                <input type="text" id="quantity" placeholder="Enter quantity" name="quantity[]" value="{{ old('quantity') }}" class="form-control form-control-sm mt-15 @error('quantity') is-invalid @enderror"/>
                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>`;
        $('#template').append(html);
    }
</script>
@endsection