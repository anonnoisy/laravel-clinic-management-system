@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Setting</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">System Settings</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">System Setting</h5>
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="system_name">System name</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="system_name" value="{{ old('system_name') }}" placeholder="Enter system name">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="system_title">System title</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="system_title" value="{{ old('system_title') }}" placeholder="Enter system title">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="office_address">Office address</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="office_address" value="{{ old('office_address') }}" placeholder="Enter office address">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="office_phone">Office phone</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="office_phone" value="{{ old('office_phone') }}" placeholder="Enter office phone">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="office_email">Office email</label>
                                <input class="form-control form-control-sm mt-15" type="email" name="office_email" value="{{ old('office_email') }}" placeholder="Enter office email">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="office_fax">Office fax</label>
                                <input class="form-control form-control-sm mt-15" type="email" name="office_fax" value="{{ old('office_fax') }}" placeholder="Enter office fax">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="system_paypal_email">Paypal email</label>
                                <input class="form-control form-control-sm mt-15" type="email" name="system_paypal_email" value="{{ old('system_paypal_email') }}" placeholder="Enter paypal email">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="system_purchase_code">Purchase code</label>
                                <input class="form-control form-control-sm mt-15" type="email" name="system_purchase_code" value="{{ old('system_purchase_code') }}" placeholder="Enter purchase code">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="system_currency">Currency</label>
                                <input class="form-control form-control-sm mt-15" type="email" name="system_currency" value="{{ old('system_currency') }}" placeholder="Enter currency">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="system_logo">System Logo</label>
                                <input type="file" id="system_logo" class="form-control form-control-sm pb-2"/>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save system setting</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
