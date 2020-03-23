@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage doctors</li>
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
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Manage Doctors</h5>
                    <p class="mb-25"></p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::user::doctor::create') }}" class="btn btn-gradient-primary mb-3">Add Doctor</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Home Phone</th>
                                                <th>Department</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($doctors as $doctor)
                                                <tr>
                                                    <td>
                                                        @if (!empty($department->image_url))
                                                            <img src="{{ $department->signed_image_url }}" alt="Department image" width="100">
                                                        @else
                                                            No image
                                                        @endif
                                                    </td>
                                                    <td>{{ $doctor->name }}</td>
                                                    <td>{{ $doctor->email }}</td>
                                                    <td>{{ $doctor->mobile_phone }}</td>
                                                    <td>{{ $doctor->home_phone }}</td>
                                                    <td>{{ $doctor->department_name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::user::doctor::edit', [
                                                            'user' => $doctor->user_id,
                                                            'doctor' => $doctor->id
                                                        ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::user::doctor::destroy', [
                                                            'doctor' => $doctor->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>No doctor found..</td>
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
