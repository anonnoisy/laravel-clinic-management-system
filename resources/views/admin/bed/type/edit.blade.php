@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Department</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::bed::type::index') }}">Manage bed types</a>
    </li>
    <li class="breadcrumb-item active">Add new bed type</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Add New Bed Type</h5>
                    <form action="{{ route('admin::bed::type::update', [
                        'type' => $type->id
                    ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="name">Bed number</label>
                                <input class="form-control form-control-sm mt-15 @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $type->name) }}" placeholder="Enter type name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="description">Bed description</label>
                                <textarea class="form-control form-control-sm mt-15 @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description type" rows="3">{{ old('description', $type->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save bed type</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
