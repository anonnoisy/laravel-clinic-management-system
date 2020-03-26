@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage receptionists</li>
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
                    <h5 class="mb-10">Manage Receptionists</h5>
                    <p class="mb-25"></p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::user::receptionist::create') }}" class="btn btn-gradient-primary mb-3">Add Receptionist</a>
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
                                            @forelse ($receptionists as $receptionist)
                                                <tr>
                                                    <td>
                                                        @if (!empty($receptionist->signed_image_url))
                                                            <img src="{{ $receptionist->signed_image_url }}" alt="receptionist image" width="100">
                                                        @else
                                                            No image
                                                        @endif
                                                    </td>
                                                    <td>{{ $receptionist->name }}</td>
                                                    <td>{{ $receptionist->email }}</td>
                                                    <td>{{ $receptionist->mobile_phone }}</td>
                                                    <td>{{ $receptionist->address }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::user::receptionist::edit', [
                                                            'user' => $receptionist->user_id,
                                                            'receptionist' => $receptionist->id
                                                            ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::user::receptionist::destroy', [
                                                            'user' => $receptionist->user_id,
                                                            'receptionist' => $receptionist->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No receptionist found..</td>
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
