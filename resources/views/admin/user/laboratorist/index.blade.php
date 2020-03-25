@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage laboratorists</li>
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
                    <h5 class="mb-10">Manage Laboratorists</h5>
                    <p class="mb-25"></p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::user::laboratorist::create') }}" class="btn btn-gradient-primary mb-3">Add Laboratorist</a>
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
                                                <th>Phone</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($laboratorists as $laboratorist)
                                                <tr>
                                                    <td>
                                                        @if (!empty($laboratorist->signed_image_url))
                                                            <img src="{{ $laboratorist->signed_image_url }}" alt="laboratorist image" width="100">
                                                        @else
                                                            No image
                                                        @endif
                                                    </td>
                                                    <td>{{ $laboratorist->name }}</td>
                                                    <td>{{ $laboratorist->email }}</td>
                                                    <td>{{ $laboratorist->mobile_phone }}</td>
                                                    <td>{{ $laboratorist->address }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::user::laboratorist::edit', [
                                                            'user' => $laboratorist->user_id,
                                                            'laboratorist' => $laboratorist->id
                                                            ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::user::laboratorist::destroy', [
                                                            'user' => $laboratorist->user_id,
                                                            'laboratorist' => $laboratorist->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No laboratorist found..</td>
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
