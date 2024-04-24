@extends('layout')
@section('title', 'Trip Create &mdash;')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('trips.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create New Trip</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('trips.index') }}">Contracts</a></div>
                    <div class="breadcrumb-item">Create New Trip</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create New Trip</h2>
                <p class="section-lead">
                    On this page you can create a new trip and fill in all fields.
                </p>

                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('trips.store') }}" method="post" class="is-validated">
                            @csrf

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Contract</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="contract_id" class="form-control @error('contract_id') is-invalid @enderror">
                                        <option value="">Select Contract</option>
                                        @foreach($contracts as $contract)
                                            <option value="{{ $contract->id }}" @selected(old('contract_id'))>{{ $contract->contract_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('contract_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Trip Date</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" name="trip_date" value="{{ old('trip_date') }}" class="form-control @error('trip_date') is-invalid @enderror">
                                    @error('trip_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Create Trip</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
