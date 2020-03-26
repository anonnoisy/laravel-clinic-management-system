@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Department</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::bed::index') }}">Manage beds</a>
    </li>
    <li class="breadcrumb-item active">Edit bed</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Edit Bed</h5>
                    <form action="{{ route('admin::bed::update', [
                        'bed' => $bed->id
                    ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="bed_number">Bed number</label>
                                <input class="form-control form-control-sm mt-15 @error('bed_number') is-invalid @enderror" type="text" name="bed_number" value="{{ old('bed_number', $bed->bed_number) }}" readonly>
                                @error('bed_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="bed_currently">Bed currently</label>
                                <input class="form-control form-control-sm mt-15 @error('bed_currently') is-invalid @enderror" type="text" name="bed_currently" value="{{ old('bed_currently', $bed->bed_currently) }}" placeholder="Enter currently bed">
                                @error('bed_currently')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="bed_usage">Bed usage</label>
                                <input class="form-control form-control-sm mt-15 @error('bed_usage') is-invalid @enderror" type="text" name="bed_usage" value="{{ old('bed_usage', $bed->bed_usage) }}" placeholder="Enter bed usage">
                                @error('bed_usage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="total_bed">Total beds</label>
                                <input class="form-control form-control-sm mt-15 @error('total_beds') is-invalid @enderror" type="text" name="total_bed" value="{{ old('total_bed', $bed->total_bed) }}" placeholder="Enter total of beds">
                                @error('total_beds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="bed_type_id">Bed type</label>
                                <select name="bed_type_id" id="bed_type_id" class="form-control form-control-sm mt-15 @error('bed_type_id') is-invalid @enderror">
                                    <option>Select bed type</option>
                                    @forelse ($types as $type)
                                        <option value="{{ $type->id }}"  @if(old('type', $bed->type->id) == $type->id) selected @endif>{{ $type->name }}</option>
                                    @empty
                                        <option>No bed type found, please create new bed type</option>
                                    @endforelse
                                </select>
                                @error('bed_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="bed_description">Bed description</label>
                                <textarea class="form-control form-control-sm mt-15 @error('bed_description') is-invalid @enderror" name="description" placeholder="Enter bed description" rows="3">{{ old('description', $bed->description) }}</textarea>
                                @error('bed_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
