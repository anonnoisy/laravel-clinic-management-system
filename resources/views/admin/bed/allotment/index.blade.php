@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage bed allotments</li>
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
                    <h5 class="mb-10">Manage bed allotments</h5>
                    <p class="mb-25">Use <code>table-responsive{-sm|-md|-lg|-xl}</code> as needed to create responsive tables up to a particular breakpoint.</p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::bed::allotment::create') }}" class="btn btn-gradient-primary mb-3">Create Bed Allotment</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Patient</th>
                                                <th>Bed type</th>
                                                <th>Allotment time</th>
                                                <th>Discharge time</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($bed_allotments as $index => $bed_allotment)
                                                <tr>
                                                    <td>{{ $index+1 }}</td>
                                                    <td>{{ $bed_allotment->patient->name }}</td>
                                                    <td>{{ $bed_allotment->bed->type->name }}</td>
                                                    <td>{{ $bed_allotment->allotment_time_formatted }}</td>
                                                    <td>{{ $bed_allotment->discharge_time_formatted }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::bed::allotment::edit', [
                                                            'allotment' => $bed_allotment->id
                                                        ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::bed::allotment::destroy', [
                                                            'bed' => $bed_allotment->bed_id,
                                                            'allotment' => $bed_allotment->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No bed allotment found..</td>
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
