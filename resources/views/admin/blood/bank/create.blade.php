@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Blood</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::blood::bank::index') }}">Manage blood banks</a>
    </li>
    <li class="breadcrumb-item active">Add new blood</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Add new blood</h5>
                    <form action="{{ route('admin::blood::bank::store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="blood_name">Blood name</label>
                                <input class="form-control form-control-sm mt-15 @error('blood_name') is-invalid @enderror" id="blood_name" type="text" name="blood_name" value="{{ old('blood_name') }}" placeholder="Name of blood">
                                @error('blood_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="status">Blood bag status</label>
                                <input class="form-control form-control-sm mt-15 @error('status') is-invalid @enderror" id="status" type="text" name="status" value="{{ old('blood_bag') }}" placeholder="Enter blood bag status">
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save blood</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
