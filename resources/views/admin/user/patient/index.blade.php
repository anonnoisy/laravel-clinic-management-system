@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Patients</li>
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
                    <h5 class="mb-10">Manage Patients</h5>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::user::patient::create') }}" class="btn btn-gradient-primary mb-3">Add Patient</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile phone</th>
                                                <th>Birth of date</th>
                                                <th>Age</th>
                                                <th>Blood group</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($patients as $patient)
                                                <tr>
                                                    <td>
                                                        @if (!empty($patient->signed_image_url))
                                                            <img src="{{ $patient->signed_image_url }}" alt="Patient image" width="100">
                                                        @else
                                                            No image
                                                        @endif
                                                    </td>
                                                    <td>{{ $patient->name }}</td>
                                                    <td>{{ $patient->email }}</td>
                                                    <td>{{ $patient->mobile_phone }}</td>
                                                    <td>{{ $patient->birth_date_formatted }}</td>
                                                    <td>{{ $patient->age }}</td>
                                                    <td>{{ $patient->blood_group }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::user::patient::edit', [
                                                            'user' => $patient->user_id,
                                                            'patient' => $patient->id
                                                            ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::user::patient::destroy', [
                                                            'user' => $patient->user_id,
                                                            'patient' => $patient->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>No patient found..</td>
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
