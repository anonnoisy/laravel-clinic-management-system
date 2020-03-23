@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('admin::department::index') }}">Manage Departments</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Manage Department Facilities</li>
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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    @endif
                    <h5 class="mb-10">Manage Department Facility</h5>
                    <p class="mb-25">This list facilities for department {{ $department->name }}, you can manage facility</p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::department::facility::create', ['department' => $department->id]) }}" class="btn btn-gradient-primary mb-3">Add Department Facility</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($departmentFacilities as $facility)
                                                <tr>
                                                    <td>{{ $facility->title }}</td>
                                                    <td>{{ $facility->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::department::facility::edit', [
                                                            'department' => $department->id,
                                                            'facility' => $facility->id
                                                        ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::department::facility::destroy', [
                                                            'department' => $department->id,
                                                            'facility' => $facility
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">No facility found..</td>
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
