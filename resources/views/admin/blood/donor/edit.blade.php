@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Blood</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::user::nurse::index') }}">Donor Management</a>
    </li>
    <li class="breadcrumb-item active">Edit donor</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Edit Donor</h5>
                    <form action="{{ route('admin::blood::donor::update', [
                        'donor' => $donor->id
                    ]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="first_name">First name</label>
                                <input class="form-control form-control-sm mt-15 @error('first_name') is-invalid @enderror" id="first_name" type="text" name="first_name" value="{{ old('first_name', $donor->first_name) }}" placeholder="Enter first name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for=";ast_name">Last name</label>
                                <input class="form-control form-control-sm mt-15 @error('last_name') is-invalid @enderror" id="last_name" type="text" name="last_name" value="{{ old('last_name', $donor->last_name) }}" placeholder="Enter last name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="email">Email</label>
                                <input class="form-control form-control-sm mt-15 @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email', $donor->email) }}" placeholder="Enter email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="mobile_phone">Phone</label>
                                <input type="mobile_phone" id="mobile_phone" placeholder="Enter mobile phone" name="mobile_phone" value="{{ old('mobile_phone', $donor->mobile_phone) }}" class="form-control form-control-sm mt-15 @error('mobile_phone') is-invalid @enderror"/>
                                @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="sex">Sex</label>
                                <select name="sex" id="sex" class="form-control form-control-sm mt-15 @error('sex') is-invalid @enderror">
                                    <option>Select sex</option>
                                    <option value="Male" @if (old('sex', $donor->sex) == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if (old('sex', $donor->sex) == 'Female') selected @endif>Female</option>
                                </select>
                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="birth_date">Birth date</label>
                                <input type="text" class="form-control form-control-sm mt-15 @error('birth_date') is-invalid @enderror datepicker-here" name="birth_date" value="{{ old('birth_date', $donor->birth_date_formatted) }}" placeholder="Enter birth date" data-language="en" />
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="blood_group">Blood group</label>
                                <select name="blood_group" id="blood_group" class="form-control form-control-sm mt-15 @error('blood_group') is-invalid @enderror">
                                    <option>Select blood group</option>
                                    @foreach ($blood_groups as $blood_group)
                                        <option value="{{ $blood_group }}" @if (old('blood_group', $donor->blood_group) == $blood_group) selected @endif>{{ $blood_group }}</option>
                                    @endforeach
                                </select>
                                @error('blood_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="last_donation_date">Last donation date</label>
                                <input type="text" class="form-control form-control-sm mt-15 @error('last_donation_date') is-invalid @enderror datepicker-here" name="last_donation_date" value="{{ old('last_donation_date', $donor->last_donation_date_formatted) }}" placeholder="Enter last donation date" data-language="en" />
                                @error('last_donation_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="address">Address</label>
                                <textarea id="address" placeholder="Enter address" name="address" class="form-control form-control-sm mt-15 @error('address') is-invalid @enderror" rows="3">{{ old('address', $donor->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save donor</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
