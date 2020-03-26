@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage bed types</li>
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
                    <h5 class="mb-10">Manage bed types</h5>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::bed::type::create') }}" class="btn btn-gradient-primary mb-3">Add Bed Type</a>
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
                                            @forelse($types as $index => $type)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $type->name }}</td>
                                                <td>{{ $type->description }}</td>
                                                <td>
                                                    <a href="{{ route('admin::bed::type::edit', [
                                                        'type' => $type->id
                                                    ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                    <form action="{{ route('admin::bed::type::destroy', [
                                                        'type' => $type->id
                                                    ]) }}" method="post" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No bed type found..</td>
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
