@extends('layout')
@section('title', 'Clients &mdash;')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Clients</h1>
                <div class="section-header-button">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('clients.index') }}">Posts</a></div>
                    <div class="breadcrumb-item">All Posts</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Clients</h2>
                <p class="section-lead">
                    You can manage all clients, such as editing, deleting and more.
                </p>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Contracts</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse($clients as $client)
                                            <tr>
                                                <td>{{ $client->id }}</td>
                                                <td>{{ $client->name }}</td>
                                                <td>
                                                    @forelse($client->contracts as $contract)
                                                            <div class="px-3">
                                                            {{$contract->contract_number}}
                                                        </div>
                                                        <div class="table-links d-flex">
                                                            <a href="{{ route('contracts.edit',$contract->id) }}">Edit</a>
                                                            <div class="bullet"></div>
                                                            <form
                                                                action="{{ route('contracts.destroy',$contract->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="border-0 bg-transparent text-danger p-0">
                                                                    Trash
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @empty
                                                        No contracts found.
                                                        <div class="bullet"></div>
                                                        <a href="{{ route('contracts.create') }}">Create </a>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    <div class="table-links d-flex">
                                                        <a href="{{ route('clients.edit',$client->id) }}">Edit</a>
                                                        <div class="bullet"></div>
                                                        <form action="{{ route('clients.destroy',$client->id) }}"
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
                                                <td colspan="3" class="text-center">No clients found.</td>
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
