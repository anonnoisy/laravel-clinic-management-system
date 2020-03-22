@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Bed</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::bed::index') }}">Manage bed allotmentss</a>
    </li>
    <li class="breadcrumb-item active">Create bed allotment</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Create Bed Allotment</h5>
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="bed_id">Bed</label>
                                <select name="bed_id" id="bed_id" class="form-control form-control-sm mt-15">
                                    <option>Select bed</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="patient_id">Patient</label>
                                <select name="patient_id" id="patient_id" class="form-control form-control-sm mt-15">
                                    <option>Select patient</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="allotment_time">Allotment time</label>
                                <input type="text" class="form-control form-control-sm mt-15 datepicker-here" name="allotment_time" value="{{ old('allotment_time') }}" placeholder="Enter allotment time" data-language="en" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="discharge_time">Discharge time</label>
                                <input type="text" class="form-control form-control-sm mt-15 datepicker-here" name="discharge_time" value="{{ old('discharge_time') }}" placeholder="Enter discharge time" data-language="en" />
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save bed</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
