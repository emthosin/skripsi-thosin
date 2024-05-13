@extends('layouts.main')

@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add New Alternative</h4>
      <div class="ml-auto text-right">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/alternatives">Alternatives</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Alternative</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <form action="/alternatives" method="POST" class="form-horizontal">
          @csrf
          <div class="card-body">
            <h4 class="card-title mb-3">Add Alternative</h4>
            <div class="form-group row">
              <label for="code" class="col-sm-3 text-left control-label col-form-label">Code</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                  placeholder="Insert Code Here" value="{{ old('code') }}">
                @error('code')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-3 text-left control-label col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                  placeholder="Insert Name Here" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="border-top">
            <div class="card-body">
              <a href="/alternatives" class="btn btn-danger"><i class="mdi mdi-close"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-all"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection