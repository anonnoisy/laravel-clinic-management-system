@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Department</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::department::index') }}">Manage departments</a>
    </li>
    <li class="breadcrumb-item active">Edit department</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Edit Department</h5>
                    <form action="{{ route('admin::department::update', $department->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="department_name">Department name</label>
                                <input class="form-control form-control-sm mt-15 @error('email') is-invalid @enderror" id="department_name"type="text" name="name" value="{{ old('name', $department->name) }}" placeholder="Name of department">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="department_description">Department description</label>
                                <textarea class="form-control form-control-sm mt-15" id="department_description" name="description" placeholder="Description of department" rows="3">{{ old('description', $department->description) }}</textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                @if(!empty($department->image_url))
                                    <img src="{{ $department->signed_image_url }}" width="100">
                                @endif
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="department_image">Department image</label>
                                <input type="file" id="department_image" name="image" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save department</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
