@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage nurses</li>
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
                    <h5 class="mb-10">Manage Nurses</h5>
                    <p class="mb-25"></p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::user::nurse::create') }}" class="btn btn-gradient-primary mb-3">Add Nurse</a>
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
                                            @forelse($nurses as $nurse)
                                            <tr>
                                                <td>
                                                    @if (!empty($department->image_url))
                                                        <img src="{{ $department->signed_image_url }}" alt="Department image" width="100">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                                <td>{{ $nurse->name }}</td>
                                                <td>{{ $nurse->email }}</td>
                                                <td>{{ $nurse->mobile_phone }}</td>
                                                <td>{{ $nurse->address }}</td>
                                                <td>
                                                    <a href="{{ route('admin::user::nurse::edit', [
                                                        'user' => $nurse->user_id,
                                                        'nurse' => $nurse->id
                                                    ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                    <form action="{{ route('admin::user::nurse::destroy', [
                                                        'nurse' => $nurse->id
                                                    ]) }}" method="post" style="display: inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No nurse found..</td>
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
