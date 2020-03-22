@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Blood</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::blood::bank::index') }}">Manage blood banks</a>
    </li>
    <li class="breadcrumb-item active">Edit blood</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Edit blood</h5>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="blood_name">Blood name</label>
                                <input class="form-control form-control-sm mt-15" id="blood_name" type="text" name="name" value="{{ old('name') }}" placeholder="Name of blood">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="blood_bag">Department description</label>
                                <input class="form-control form-control-sm mt-15" id="blood_bag" type="text" name="description" value="{{ old('blood_bag') }}" placeholder="Enter blood bag status">
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
