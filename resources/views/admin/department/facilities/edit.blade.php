@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Department</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
        <a href="{{ route('admin::department::index') }}">Manage departments</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin::department::facility::index', ['department' => $department->id]) }}">Manage department facilities</a>
    </li>
    <li class="breadcrumb-item active">Edit department facility</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Add New Department Facilities</h5>
                    <form action="{{ route('admin::department::facility::update', [
                        'department' => $department->id,
                        'facility' => $departmentFacility->id
                    ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="title">Title</label>
                                <input class="form-control form-control-sm mt-15" id="title" name="title" value="{{ old('title', $departmentFacility->title) }}" type="text" placeholder="Name of department">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control form-control-sm mt-15" id="description" name="description" placeholder="Description of department" rows="3">{{ old('description', $departmentFacility->description) }}</textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="department">Department</label>
                                <input type="text" id="department" value="" class="form-control form-control-sm pb-2" readonly>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
