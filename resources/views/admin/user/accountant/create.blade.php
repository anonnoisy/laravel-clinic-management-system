@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Users Management</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::user::accountant::index') }}">Accountants Management</a>
    </li>
    <li class="breadcrumb-item active">Add new accountant</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Add New Accountant</h5>
                    <form action="{{ route('admin::user::accountant::store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="first_name">First name</label>
                                <input class="form-control form-control-sm mt-15 @error('first_name') is-invalid @enderror" id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="last_name">Last name</label>
                                <input class="form-control form-control-sm mt-15 @error('last_name') is-invalid @enderror" id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="email">Email</label>
                                <input class="form-control form-control-sm mt-15 @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" placeholder="Enter password" name="password" class="form-control form-control-sm mt-15 @error('password') is-invalid @enderror"/>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="mobile_phone">Mobile phone</label>
                                <input type="mobile_phone" id="mobile_phone" placeholder="Enter mobile phone" name="mobile_phone" value="{{ old('mobile_phone') }}" class="form-control form-control-sm mt-15 @error('mobile_phone') is-invalid @enderror"/>
                                @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="home_phone">Home phone</label>
                                <input type="home_phone" id="home_phone" placeholder="Enter home phone" name="home_phone" value="{{ old('home_phone') }}" class="form-control form-control-sm mt-15 @error('home_phone') is-invalid @enderror"/>
                                @error('home_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="address">Address</label>
                                <textarea id="address" placeholder="Enter address" name="address" class="form-control form-control-sm mt-15 @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="image">Image</label>
                                <input class="form-control form-control-sm mt-15 @error('image') is-invalid @enderror" type="file" id="image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save accountant</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
