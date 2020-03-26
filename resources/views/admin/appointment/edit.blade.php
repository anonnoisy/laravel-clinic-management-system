@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Appointments Management</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::appointment::index') }}">Appointments Management</a>
    </li>
    <li class="breadcrumb-item active">Edit appointment</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Edit Appointment</h5>
                    <form action="{{ route('admin::appointment::update', [
                        'appointment' => $appointment->id
                    ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="patient">Patient</label>
                                <select name="patient_id" id="patient" class="form-control form-control-sm mt-15 @error('patient_id') is-invalid @enderror">
                                    <option>Select patient</option>
                                    @foreach (['Pending', 'Checking', 'Completed'] as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="doctor">Doctor</label>
                                <select name="doctor_id" id="doctor" class="form-control form-control-sm mt-15 @error('doctor_id') is-invalid @enderror">
                                    <option>Select doctor</option>
                                    @foreach (['Pending', 'Checking', 'Completed'] as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="appointment_time">Appointment time</label>
                                <input type="text" id="appointment_time" placeholder="HH:mm" name="appointment_time" value="{{ old('appointment_time', $appointment->) }}" class="form-control form-control-sm mt-15 @error('appointment_time') is-invalid @enderror"/>
                                @error('appointment_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="appointment_date">Appointment date</label>
                                <input type="text" id="appointment_date" placeholder="Enter home phone" name="appointment_date" value="{{ old('appointment_date', $appointment->) }}" class="form-control form-control-sm mt-15 datepicker-here @error('appointment_date') is-invalid @enderror"/>
                                @error('appointment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="primary_diagnoses">Primary diagnoses</label>
                                <textarea id="primary_diagnoses" placeholder="Enter primary diagnoses" name="primary_diagnoses" class="form-control form-control-sm mt-15 @error('primary_diagnoses') is-invalid @enderror" rows="3">{{ old('primary_diagnoses', $appointment->) }}</textarea>
                                @error('primary_diagnoses')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="secondary_diagnoses">Secondary diagnoses</label>
                                <textarea id="secondary_diagnoses" placeholder="Enter secondary diagnoses" name="secondary_diagnoses" class="form-control form-control-sm mt-15 @error('secondary_diagnoses') is-invalid @enderror" rows="3">{{ old('secondary_diagnoses', $appointment->) }}</textarea>
                                @error('secondary_diagnoses')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="clinical_notes">Clinical notes</label>
                                <textarea id="clinical_notes" placeholder="Enter clinical notes" name="clinical_notes" class="form-control form-control-sm mt-15 @error('clinical_notes') is-invalid @enderror" rows="3">{{ old('clinical_notes', $appointment->) }}</textarea>
                                @error('clinical_notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm mt-15 @error('status') is-invalid @enderror">
                                    @foreach (['Pending', 'Checking', 'Completed'] as $status)
                                        <option value="{{ $status }}" @if($appointment->status == $status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save appointment</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
