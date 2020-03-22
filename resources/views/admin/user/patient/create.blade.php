@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Patient</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::user::patient::index') }}">Manage Patients</a>
    </li>
    <li class="breadcrumb-item active">Add new patient</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Add New Patient</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="first_name">First name</label>
                                <input class="form-control form-control-sm mt-15" id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name">
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for=";ast_name">Last name</label>
                                <input class="form-control form-control-sm mt-15" id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name">
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="email">Email</label>
                                <input class="form-control form-control-sm mt-15" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" placeholder="Enter password" name="password" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="mobile_phone">Mobile phone</label>
                                <input type="text" id="mobile_phone" placeholder="Enter mobile phone" name="mobile_phone" value="{{ old('mobile_phone') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="home_phone">Home phone</label>
                                <input type="text" id="home_phone" placeholder="Enter home phone" name="home_phone" value="{{ old('home_phone') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="sex">Sex</label>
                                <select name="sex" id="sex" class="form-control form-control-sm pb-2">
                                    <option>Select sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="birth_of_date">Birth of date</label>
                                <input type="text" id="birth_of_date" placeholder="Enter home phone" name="birth_of_date" value="{{ old('birth_of_date') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="age">Age</label>
                                <input type="text" id="age" placeholder="Enter home phone" name="age" value="{{ old('age') }}" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="blood_group">Blood group</label>
                                <select name="blood_group" id="blood_group" class="form-control form-control-sm pb-2">
                                    <option>Select blood group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="address">Address</label>
                                <textarea id="address" placeholder="Enter address" name="address" class="form-control form-control-sm pb-2" rows="3">{{ old('address') }}</textarea>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="photo">Photo</label>
                                <input class="form-control form-control-sm pb-2" type="file" id="photo" name="photo">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save patient</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
