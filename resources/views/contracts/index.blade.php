@extends('layout')
@section('title', 'Contracts &mdash;')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Contracts</h1>
                <div class="section-header-button">
                    <a href="{{ route('contracts.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contracts</a></div>
                    <div class="breadcrumb-item">All Contracts</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">contracts</h2>
                <p class="section-lead">
                    You can manage all contracts, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{ route('contracts.index') }}" class="mb-5">
                                    <div class="row justify-content-between">
                                        <div class="col-3">
                                            <select class="form-control selectric" name="client_id">
                                                <option value="">All</option>
                                                @forelse($clients as $client)
                                                    <option
                                                        value="{{$client->id}}" @selected($client->id == request()->client_id ?? 'selected')>{{$client->name}}</option>
                                                @empty
                                                    <option value="">No clients found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-3 d-flex justify-content-between">
                                            <input type="date" class="form-control" name="start_date"
                                                   value="{{ old('start_date') }}" placeholder="start date">
                                        </div>

                                        <div class="col-3 d-flex justify-content-between">
                                            <input type="date" class="form-control" name="end_date"
                                                   value="{{ old('end_date') }}" placeholder="end date">
                                        </div>

                                        <div class="col-2 d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>id</th>
                                            <th>contract number</th>
                                            <th>start date</th>
                                            <th>end date</th>
                                            <th>trips count</th>
                                            <th>trips done</th>
                                            <th>client</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse($contracts as $contract)
                                            <tr>
                                                <td>{{ $contract->id }}</td>
                                                <td>{{ $contract->contract_number }}</td>
                                                <td>{{ $contract->start_date }}</td>
                                                <td>{{ $contract->end_date }}</td>
                                                <td>{{ $contract->trips_count }}</td>
                                                <td>{{ $contract->trips_done_count }}</td>
                                                <td>{{ $contract->client->name }}
                                                    <div class="table-links d-flex">
                                                        <a href="{{ route('clients.edit',$contract->client->id) }}">Edit</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-links d-flex">
                                                        <a href="{{ route('contracts.edit',$contract->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ route('contracts.destroy',$contract->id) }}"
                                                              method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="border-0 bg-transparent text-danger p-0">
                                                                Trash
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($contract->trips_done_count == $contract->trips_count)
                                                        <span class="text-success">completed</span>
                                                    @elseif($contract->trips_done_count < $contract->trips_count && now()->toDateString() > $contract->end_date  )
                                                        <span class="text-danger">ended</span>
                                                    @elseif($contract->trips_done_count < $contract->trips_count &&
                                                     now()->toDateString() <= $contract->end_date)
                                                        <span class="text-primary">current</span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No clients found.</td>
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
