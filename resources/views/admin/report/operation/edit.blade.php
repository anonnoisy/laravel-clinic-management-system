@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Report Management</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::report::operation::index') }}">Operation Management</a>
    </li>
    <li class="breadcrumb-item active">Edit operation</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Edit Operation</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="patient">Patient</label>
                                <select name="patient_id" id="patient" class="form-control form-control-sm mt-15 selectize">
                                    <option>Select patient</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="date">Date</label>
                                <input type="text" class="form-control form-control-sm mt-15 datepicker-here" name="date" value="{{ old('date') }}" placeholder="Enter date" data-language="en" />
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="file">File</label>
                                <input class="form-control form-control-sm pb-2" type="file" id="file" name="file">
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="description">Description</label>
                                <textarea id="description" placeholder="Enter description" name="description" class="form-control form-control-sm pb-2" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save operation</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
