@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage departments</li>
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
                    <h5 class="mb-10">Manage departments</h5>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::department::create') }}" class="btn btn-gradient-primary mb-3">Add Department</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($departments as $department)
                                                <tr>
                                                    <td>
                                                        @if (!empty($department->image_url))
                                                            <img src="{{ $department->signed_image_url }}" alt="Department image" width="100">
                                                        @else
                                                            <td>No image</td>
                                                        @endif
                                                    </td>
                                                    <td>{{ $department->name }}</td>
                                                    <td>{{ $department->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::department::facility::index', ['department' => $department->id]) }}" class="btn btn-secondary btn-sm mr-25">Manage facilities</a>
                                                        <a href="{{ route('admin::department::edit', ['department' => $department->id]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::department::destroy', ['department' => $department->id]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No department found..</td>
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
