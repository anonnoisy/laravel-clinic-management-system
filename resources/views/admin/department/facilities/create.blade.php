@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Department</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item">
        <a href="{{ route('admin::department::index') }}">Manage departments</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin::department::facility::index', ['department' => $department]) }}">Manage department facilities</a>
    </li>
    <li class="breadcrumb-item active">Add new department facility</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h5 class="mb-10">Add New Department Facilities</h5>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div>{{$error}}</div>
                                @endforeach
                            @endif
                            <form action="{{ route('admin::department::facility::store', ['department' => $department->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="department_id" value="{{ $department->id }}">
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control form-control-sm mt-15 @error('email') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" type="text" placeholder="Name of department">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control form-control-sm mt-15" id="description" name="description" placeholder="Description of department" rows="3">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label for="department">Department</label>
                                        <input type="text" id="department" value="{{ $department->name }}" class="form-control form-control-sm pb-2" readonly>
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" type="submit">Save facility</button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
