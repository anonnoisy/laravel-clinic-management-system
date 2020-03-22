@extends('layouts.app')

@section('style')
<!-- Selectize -->
<link href="/libs/selectize/css/selectize.css" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<h4 class="page-title mb-1">Invoices</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::invoice::index') }}">Manage invoices</a>
    </li>
    <li class="breadcrumb-item active">Edit invoice</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="mb-10">Edit Invoice</h5>
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="title">Department name</label>
                                <input class="form-control form-control-sm mt-15" id="title" type="text" name="name" value="{{ old('name') }}" placeholder="Name of department">
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="invoice_number">Invoice number</label>
                                <input class="form-control form-control-sm mt-15" id="invoice_number" type="text" name="description" value="{{ old('invoice_number') }}" placeholder="Invoice number" readonly>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="patient">Patient</label>
                                <select name="patient_id" id="patient" class="form-control form-control-sm mt-15 selectize">
                                    <option>Select patient</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="creation_date">Creation date</label>
                                <input type="text" class="form-control form-control-sm mt-15 datepicker-here" name="creation_date" value="{{ old('creation_date') }}" placeholder="Enter creation date" data-language="en" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="due_date">Due date</label>
                                <input type="text" class="form-control form-control-sm mt-15 datepicker-here" name="due_date" value="{{ old('due_date') }}" placeholder="Enter due date" data-language="en" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="vat_percentage">Vat percentage</label>
                                <input type="text" class="form-control form-control-sm mt-15" name="vat_percentage" value="{{ old('vat_percentage') }}" placeholder="Enter vat percentage" data-language="en" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="discount_amount">Discount amount</label>
                                <input type="text" class="form-control form-control-sm mt-15" name="discount_amount" value="{{ old('discount_amount') }}" placeholder="Enter discount amount" data-language="en" />
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="payment_status">Payment status</label>
                                <select name="payment_status" id="payment_status" class="form-control form-control-sm mt-15">
                                    <option>Select payment status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>
                            <hr />
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="invoice_entry">Invoice entry</label>
                                <input type="text" class="form-control form-control-sm mt-15" name="invoice_entry" value="{{ old('invoice_entry') }}" placeholder="Enter description" data-language="en" />
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control form-control-sm mt-15" name="amount" value="{{ old('amount') }}" placeholder="Enter amount" data-language="en" />
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

@section('script')
<!-- Selectize -->
<script src="/libs/selectize/js/standalone/selectize.min.js"></script>
<!-- Form Advanced init -->
<script src="/js/pages/form-advanced.init.js"></script>
@endsection
