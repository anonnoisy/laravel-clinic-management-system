@extends('layouts.app')

@section('breadcrumb')
<h4 class="page-title mb-1">Medicine</h4>
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item active">
        <a href="{{ route('admin::medicine::index') }}">Manage Medicines</a>
    </li>
    <li class="breadcrumb-item active">Edit medicine</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Edit Medicine</h5>
                    <form action="{{ route('admin::medicine::update', ['medicine' => $medicine->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="name">Medicine name</label>
                                <input class="form-control form-control-sm mt-15 @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name', $medicine->name) }}" placeholder="Enter medicine name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control form-control-sm mt-15 @error('category_id') is-invalid @enderror">
                                    <option>Select medicine category</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}" @if (old('category_id', $medicine->category()->first()->id) == $category->id) selected @endif>{{ $category->name }}</option>
                                    @empty
                                        <option>No category found, please add new category first</option>
                                    @endforelse
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="price">Price</label>
                                <input class="form-control form-control-sm mt-15 @error('price') is-invalid @enderror" id="price" type="price" name="price" value="{{ old('price', $medicine->price) }}" placeholder="Enter price">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-6 form-group">
                                <label for="quantity">Total quantity</label>
                                <input type="text" id="quantity" placeholder="Enter quantity" name="quantity" value="{{ old('quantity', $medicine->quantity) }}" class="form-control form-control-sm mt-15 @error('quantity') is-invalid @enderror"/>
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="manufacture_company">Manufacturing company</label>
                                <input type="text" id="manufacture_company" placeholder="Enter manufacturing company" name="manufacture_company" value="{{ old('manufacture_company', $medicine->manufacture_company) }}" class="form-control form-control-sm mt-15 @error('manufacture_company') is-invalid @enderror"/>
                                @error('manufacture_company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="description">Description</label>
                                <textarea id="description" placeholder="Enter description" name="description" class="form-control form-control-sm mt-15 @error('description') is-invalid @enderror" rows="3">{{ old('description', $medicine->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" type="submit">Save medicine</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
