@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Appointment</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage appointments</li>
    </ol>
</nav>
<!-- /Breadcrumb -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Manage Appointment</h5>
                    <p class="mb-25"></p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::appointment::create') }}" class="btn btn-gradient-primary mb-3">Add Appointment</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Patient</th>
                                                <th>Doctor</th>
                                                <th>Appointment time</th>
                                                <th>Appointment date</th>
                                                <th>Appointment status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($appointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->appointment_number }}</td>
                                                <td>{{ $appointment->patient->name }}</td>
                                                <td>{{ $appointment->doctor->name }}</td>
                                                <td>{{ $appointment->time }}</td>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->status }}</td>
                                                <td>
                                                    <a href="{{ route('admin::appointment::edit', [
                                                        'appointment' => $appointment->id
                                                    ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                    <form action="{{ route('admin::appointment::destroy') }}" method="post" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">No appointment found..</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
