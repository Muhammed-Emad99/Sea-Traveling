@extends('layout')
@section('title', 'Contract Create &mdash;')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('contracts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create New Contract</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('contracts.index') }}">Contracts</a></div>
                    <div class="breadcrumb-item">Create New Contract</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create New Contract</h2>
                <p class="section-lead">
                    On this page you can create a new contract and fill in all fields.
                </p>

                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('contracts.store') }}" method="post" class="is-validated">
                            @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start Date</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror">
                                    @error('start_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">End Date</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror">
                                    @error('end_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Trip Counts</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="number" name="trips_count" value="{{ old('trips_count') }}" class="form-control @error('trips_count') is-invalid @enderror">
                                    @error('trips_count')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Client</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" @selected(old('client_id'))>{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Create Contract</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
