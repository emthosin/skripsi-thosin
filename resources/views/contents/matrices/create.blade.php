@extends('layouts.main')

@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Add Matrix Value</h4>
      <div class="ml-auto text-right">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/matrices">Matrix</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Matrix Value</li>
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
        <form action="/matrices" method="POST" class="form-horizontal">
          @csrf
          <div class="card-body">
            <h4 class="card-title mb-3">Add Matrix Value</h4>
            <div class="form-group row">
              <label class="col-md-3 m-t-15">Alternative</label>
              <div class="col-md-9">
                <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                  name="alternative_id">
                  <option>Choose Alternative</option>

                  @foreach ($alternatives as $alternative)
                  @if (old('alternative_id') == $alternative->id)
                  <option value="{{ $alternative->id }}" selected>{{ $alternative->name }}</option>
                  @else
                  <option value="{{ $alternative->id }}">{{ $alternative->name }}</option>
                  @endif
                  @endforeach

                </select>
              </div>
            </div>


            <div class="form-group row">
              <label class="col-md-3 m-t-15">Criteria</label>
              <div class="col-md-9">
                <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="criteria_id">
                  <option>Choose Criteria</option>

                  @foreach ($criterias as $criteria)
                  @if (old('criteria_id') == $criteria->id)
                  <option value="{{ $criteria->id }}" selected>{{ $criteria->name }}</option>
                  @else
                  <option value="{{ $criteria->id }}">{{ $criteria->name }}</option>
                  @endif
                  @endforeach

                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="value" class="col-sm-3 text-left control-label col-form-label">Value</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value"
                  placeholder="Insert Value Here" value="{{ old('value') }}">
                @error('value')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

<!--            <div class="form-group row">
              <label for="price" class="col-sm-3 text-left control-label col-form-label">Weekly Price in GBP</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                  placeholder="Insert Value Here" value="{{ old('price') }}">
                @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="length" class="col-sm-3 text-left control-label col-form-label">Contract Length</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('length') is-invalid @enderror" id="length" name="length"
                  placeholder="Insert Value Here" value="{{ old('length') }}">
                @error('length')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="type" class="col-sm-3 text-left control-label col-form-label">Bed Type</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type"
                  placeholder="Insert Value Here" value="{{ old('type') }}">
                @error('type')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="size" class="col-sm-3 text-left control-label col-form-label">Bedroom Size</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size"
                  placeholder="Insert Value Here" value="{{ old('size') }}">
                @error('size')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="facilities" class="col-sm-3 text-left control-label col-form-label">Bedrooms Facilities</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('facilities') is-invalid @enderror" id="facilities" name="facilities"
                  placeholder="Insert Value Here" value="{{ old('facilities') }}">
                @error('facilities')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="roomate" class="col-sm-3 text-left control-label col-form-label">Roomate</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('roomate') is-invalid @enderror" id="roomate" name="roomate"
                  placeholder="Insert Value Here" value="{{ old('roomate') }}">
                @error('roomate')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="kitchen" class="col-sm-3 text-left control-label col-form-label">Kitchen Facilities</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('kitchen') is-invalid @enderror" id="kitchen" name="kitchen"
                  placeholder="Insert Value Here" value="{{ old('kitchen') }}">
                @error('kitchen')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="kitchenette" class="col-sm-3 text-left control-label col-form-label">Shared Kitchenette</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('kitchenette') is-invalid @enderror" id="kitchenette" name="kitchenette"
                  placeholder="Insert Value Here" value="{{ old('kitchenette') }}">
                @error('kitchenette')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="residence" class="col-sm-3 text-left control-label col-form-label">Number of Residence</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('residence') is-invalid @enderror" id="residence" name="residence"
                  placeholder="Insert Value Here" value="{{ old('residence') }}">
                @error('residence')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="distance" class="col-sm-3 text-left control-label col-form-label">Distance to Uni</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('distance') is-invalid @enderror" id="distance" name="distance"
                  placeholder="Insert Value Here" value="{{ old('distance') }}">
                @error('distance')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="parking" class="col-sm-3 text-left control-label col-form-label">Storage/Parking</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('parking') is-invalid @enderror" id="parking" name="parking"
                  placeholder="Insert Value Here" value="{{ old('parking') }}">
                @error('parking')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="gym" class="col-sm-3 text-left control-label col-form-label">On-Site Gym</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('gym') is-invalid @enderror" id="gym" name="gym"
                  placeholder="Insert Value Here" value="{{ old('gym') }}">
                @error('gym')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="review" class="col-sm-3 text-left control-label col-form-label">Google Maps Review</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('review') is-invalid @enderror" id="review" name="review"
                  placeholder="Insert Value Here" value="{{ old('review') }}">
                @error('review')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            
            <div class="form-group row">
              <label for="rating" class="col-sm-3 text-left control-label col-form-label">Google Maps Rating</label>
              <div class="col-sm-9">
                <input type="text" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating"
                  placeholder="Insert Value Here" value="{{ old('rating') }}">
                @error('rating')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
-->
          </div>
          <div class="border-top">
            <div class="card-body">
              <a href="/matrices" class="btn btn-danger"><i class="mdi mdi-close"></i> Cancel</a>
              <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-all"></i> Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection