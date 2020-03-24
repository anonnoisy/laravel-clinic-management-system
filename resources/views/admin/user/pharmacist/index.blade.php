@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage pharmacists</li>
    </ol>
</nav>
<!-- /Breadcrumb -->
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    @include('layouts.components.alert')
                    <h5 class="mb-10">Manage Pharmacists</h5>
                    <p class="mb-25"></p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::user::pharmacist::create') }}" class="btn btn-gradient-primary mb-3">Add Pharmacist</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile phone</th>
                                                <th>Address</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pharmacists as $pharmacist)
                                                <tr>
                                                    <td>
                                                        @if (!empty($pharmacist->signed_image_url))
                                                            <img src="{{ $pharmacist->signed_image_url }}" alt="Pharmacist image" width="100">
                                                        @else
                                                            No image
                                                        @endif
                                                    </td>
                                                    <td>{{ $pharmacist->name }}</td>
                                                    <td>{{ $pharmacist->email }}</td>
                                                    <td>{{ $pharmacist->mobile_phone }}</td>
                                                    <td>{{ $pharmacist->address }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::user::pharmacist::edit', [
                                                            'user' => $pharmacist->user_id,
                                                            'pharmacist' => $pharmacist->id
                                                            ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::user::pharmacist::destroy', [
                                                            'user' => $pharmacist->user_id,
                                                            'pharmacist' => $pharmacist->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No pharmacist found..</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
