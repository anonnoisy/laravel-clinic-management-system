@extends('layouts.app')

@section('breadcrumb')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clinic</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage medicines</li>
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
                    <h5 class="mb-10">Manage Medicines</h5>
                    <p class="mb-25">Use <code>table-responsive{-sm|-md|-lg|-xl}</code> as needed to create responsive tables up to a particular breakpoint.</p>
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin::medicine::create') }}" class="btn btn-gradient-primary mb-3">Add Medicine</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive-md">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Total quantity</th>
                                                <th>Sold quantity</th>
                                                <th>Manufacturing company</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($medicines as $medicine)
                                                <tr>
                                                    <td>{{ $medicine->name }}</td>
                                                    <td>{{ $medicine->category()->first()->name }}</td>
                                                    <td>{{ $medicine->price }}</td>
                                                    <td>{{ $medicine->quantity }}</td>
                                                    <td></td>
                                                    <td>{{ $medicine->manufacture_company }}</td>
                                                    <td>{{ $medicine->description }}</td>
                                                    <td>{{ $medicine->status }}</td>
                                                    <td>
                                                        <a href="{{ route('admin::medicine::edit', [
                                                            'medicine' => $medicine->id
                                                        ]) }}" class="btn btn-info btn-sm mr-25">Edit</a>
                                                        <form action="{{ route('admin::medicine::destroy', [
                                                            'medicine' => $medicine->id
                                                        ]) }}" method="post" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm mr-25">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>No medicine found..</td>
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
