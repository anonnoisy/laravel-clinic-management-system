@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Setting</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">SMS Settings</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">SMS Setting</h5>
                    <form action="" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="sms_twilio_number">Twilio number</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="sms_twilio_number" value="{{ old('sms_twilio_number') }}" placeholder="Enter twilio number">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="sms_twilio_sid">Twilio SID</label>
                                <input class="form-control form-control-sm mt-15" type="text" name="sms_twilio_sid" value="{{ old('sms_twilio_sid') }}" placeholder="Enter twilio SID">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="sms_twilio_token">Twilio token</label>
                                <input class="form-control form-control-sm mt-15" type="password" name="sms_twilio_token" value="{{ old('sms_twilio_token') }}" placeholder="Enter twilio token">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save sms setting</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
