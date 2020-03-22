@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Department</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::bed::index') }}">Manage beds</a>
    </li>
    <li class="breadcrumb-item active">Add new bed</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Add New Bed</h5>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="bed_number">Bed number</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="bed_number" value="{{ old('bed_number') }}" placeholder="Enter bed number">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="total_bed">Total beds</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="total_bed" value="{{ old('total_bed') }}" placeholder="Enter total of beds">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="bed_type">Bed type</label>
                                <select name="bed_type" id="bed_type" class="form-control form-control-sm mt-15">
                                    <option>Select bed type</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="bed_description">Bed description</label>
                                <textarea class="form-control form-control-sm mt-15" name="description" placeholder="Description of department" rows="3">{{ old('description') }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save bed</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
