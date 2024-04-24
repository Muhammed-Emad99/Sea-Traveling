@extends('layout')
@section('title', 'Client Edit &mdash;')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('clients.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create New Client</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('clients.index') }}">Posts</a></div>
                    <div class="breadcrumb-item">Edit Client</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Client</h2>
                <p class="section-lead">
                    On this page you can edit a client .
                </p>

                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('clients.update',$client->id) }}" method="post" class="is-validated">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" name="name" value="{{ old('name',$client->name) }}" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary">Update Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
