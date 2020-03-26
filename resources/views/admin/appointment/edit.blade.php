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
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="patient">Patient</label>
                                <select name="patient_id" id="patient" class="form-control form-control-sm mt-15 @error('patient_id') is-invalid @enderror">
                                    <option>Select patient</option>
                                    @forelse ($patients as $patient)
                                        <option value="{{ $patient->id }}" @if(old('patient_id', $appointment->patient_id) == $patient->id) selected @endif>{{ $patient->name }}</option>
                                    @empty
                                        <option>No patient found, please create new patient</option>
                                    @endforelse
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
                                    @forelse ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" @if(old('patient_id', $appointment->doctor_id) == $patient->id) selected @endif>{{ $doctor->name }}</option>
                                    @empty
                                        <option>No doctor found, please add new doctor</option>
                                    @endforelse
                                </select>
                                @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="time">Appointment time</label>
                                <input type="text" id="time" placeholder="HH:mm" name="time" value="{{ old('time', $appointment->time_formatted) }}" class="form-control form-control-sm mt-15 @error('time') is-invalid @enderror"/>
                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="date">Appointment date</label>
                                <input type="text" id="date" placeholder="Enter appointment date" name="date" value="{{ old('date', $appointment->date_formatted) }}" data-language="en" class="form-control form-control-sm mt-15 datepicker-here @error('date') is-invalid @enderror"/>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="primary_diagnoses">Primary diagnoses</label>
                                <textarea id="primary_diagnoses" placeholder="Enter primary diagnoses" name="primary_diagnoses" class="form-control form-control-sm mt-15 @error('primary_diagnoses') is-invalid @enderror" rows="3">{{ old('primary_diagnoses', $appointment->primary_diagnoses) }}</textarea>
                                @error('primary_diagnoses')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="secondary_diagnoses">Secondary diagnoses</label>
                                <textarea id="secondary_diagnoses" placeholder="Enter secondary diagnoses" name="secondary_diagnoses" class="form-control form-control-sm mt-15 @error('secondary_diagnoses') is-invalid @enderror" rows="3">{{ old('secondary_diagnoses', $appointment->secondary_diagnoses) }}</textarea>
                                @error('secondary_diagnoses')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="clinical_notes">Clinical notes</label>
                                <textarea id="clinical_notes" placeholder="Enter clinical notes" name="clinical_notes" class="form-control form-control-sm mt-15 @error('clinical_notes') is-invalid @enderror" rows="3">{{ old('clinical_notes', $appointment->clinical_notes) }}</textarea>
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
                                        <option value="{{ $status }}" @if(old('status', $appointment->status) == $status) selected @endif>{{ $status }}</option>
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
