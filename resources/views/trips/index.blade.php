@extends('layout')
@section('title', 'Trips &mdash;')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Trips</h1>
                <div class="section-header-button">
                    <a href="{{ route('trips.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('trips.index') }}">Trips</a></div>
                    <div class="breadcrumb-item">All Trips</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">trips</h2>
                <p class="section-lead">
                    You can manage all trips, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>id</th>
                                            <th>trip date</th>
                                            <th>contract number</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse($trips as $trip)
                                            <tr>
                                                <td>{{ $trip->id }}</td>
                                                <td>{{ $trip->trip_date }}</td>
                                                <td>
                                                    {{ $trip->contract->contract_number }}
                                                    <div class="table-links d-flex">
                                                        <a href="{{ route('contracts.edit',$trip->contract->id) }}">Edit</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-links d-flex">
                                                        <a href="{{ route('trips.edit',$trip->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ route('trips.destroy',$trip->id) }}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="border-0 bg-transparent text-danger p-0">
                                                                Trash
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No trips found.</td>
                                            </tr>
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
