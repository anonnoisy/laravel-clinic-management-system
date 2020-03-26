@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Appointments Management</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::appointment::index') }}">Appointments Management</a>
    </li>
    <li class="breadcrumb-item active">Add new appointment</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Add New Appointment</h5>
                    <form action="{{ route('admin::appointment::store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="patient">Patient</label>
                                <select name="patient_id" id="patient" class="form-control">
                                    <option>Select patient</option>
                                    @foreach (['Pending', 'Checking', 'Completed'] as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="doctor">Doctor</label>
                                <select name="doctor_id" id="doctor" class="form-control">
                                    <option>Select doctor</option>
                                    @foreach (['Pending', 'Checking', 'Completed'] as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="appointment_time">Appointment time</label>
                                <input type="text" id="appointment_time" placeholder="HH:mm" name="appointment_time" value="{{ old('appointment_time') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="appointment_date">Appointment date</label>
                                <input type="text" id="appointment_date" placeholder="Enter home phone" name="appointment_date" value="{{ old('appointment_date') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="primary_diagnoses">Primary diagnoses</label>
                                <textarea id="primary_diagnoses" placeholder="Enter primary diagnoses" name="primary_diagnoses" class="form-control form-control-sm pb-2" rows="3">{{ old('primary_diagnoses') }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="secondary_diagnoses">Secondary diagnoses</label>
                                <textarea id="secondary_diagnoses" placeholder="Enter secondary diagnoses" name="secondary_diagnoses" class="form-control form-control-sm pb-2" rows="3">{{ old('secondary_diagnoses') }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="clinical_notes">Clinical notes</label>
                                <textarea id="clinical_notes" placeholder="Enter clinical notes" name="clinical_notes" class="form-control form-control-sm pb-2" rows="3">{{ old('clinical_notes') }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach (['Pending', 'Checking', 'Completed'] as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save accountant</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
