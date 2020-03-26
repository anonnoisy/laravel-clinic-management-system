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
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Create Bed Allotment</h5>
                    <form action="{{ route('admin::bed::allotment::store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="bed_id">Bed</label>
                                <select name="bed_id" id="bed_id" class="form-control form-control-sm mt-15 @error('bed_id') is-invalid @enderror">
                                    <option>Select bed</option>
                                    @forelse ($beds as $bed)
                                        <option value="{{ $bed->id }}" @if(old('bed_id') == $bed->id) selected @endif>{{ $bed->bed_number }}</option>
                                    @empty
                                        <option>No bed found, please add new bed</option>
                                    @endforelse
                                </select>
                                @error('bed_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="patient_id">Patient</label>
                                <select name="patient_id" id="patient_id" class="form-control form-control-sm mt-15 @error('patient_id') is-invalid @enderror">
                                    <option>Select patient</option>
                                    @forelse ($patients as $patient)
                                        <option value="{{ $patient->id }}" @if(old('patient_id') == $bed->id) selected @endif>{{ $patient->name }}</option>
                                    @empty
                                        <option>No patient found, please add new patient</option>
                                    @endforelse
                                </select>
                                @error('patient_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="allotment_time">Allotment time</label>
                                <input type="text" class="form-control form-control-sm mt-15 @error('allotment_time') is-invalid @enderror datepicker-here" name="allotment_time" value="{{ old('allotment_time') }}" placeholder="Enter allotment time" data-language="en" />
                                @error('allotment_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="discharge_time">Discharge time</label>
                                <input type="text" class="form-control form-control-sm mt-15 @error('discharge_time') is-invalid @enderror datepicker-here" name="discharge_time" value="{{ old('discharge_time') }}" placeholder="Enter discharge time" data-language="en" />
                                @error('discharge_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
