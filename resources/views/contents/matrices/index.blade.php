@extends('layouts.main')

@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Matrix</h4>
      <div class="ml-auto text-right">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Matrix</li>
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
        <div class="card-body">
          <h5 class="card-title mb-3">Data</h5>
          <a href="/matrices/create" class="btn btn-primary"><i class="mdi mdi-library-plus"></i> Add Data</a>

          @if (!$data->isEmpty())
          {{-- <a href="#" class="btn btn-success"><i class="mdi mdi-calculator"></i> Calculate</a> --}}
          <a href="/count" class="btn btn-success"><i class="mdi mdi-calculator"></i> Calculate</a>
          <a href="javascript:void(0)" class="btn btn-danger btn-truncate"><i class="mdi mdi-delete"></i>
            Delete All Data</a>
          <form action="/matrices/truncate" method="POST" id="truncate-form" class="d-inline-block">
            @csrf
          </form>
          @endif

          <div class="table-responsive mt-3">
            <table id="zero_config" class="table table-striped table-bordered matrix-datatable">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Code</th>
                  <th>Alternative</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>{{ $criterias[$i]->name }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($matrix)
                @endphp

                @foreach ($matrix as $key)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $matrix[$loop->iteration][1]->alternative_code }}</td>
                  <td>{{ $matrix[$loop->iteration][1]->alternative_name }}</td>

                  @foreach ($key as $value)

                  <td>
                    <div class="d-flex flex-row justify-content-between">
                      {{ round($value->value, 4) }}
                      <div>
                        <a href="/matrices/{{ $value->id }}/edit" class="badge badge-warning text-white"><i
                            class="mdi mdi-pencil"></i></a>
                        {{-- <a href="javascript:void(0)" class="badge badge-danger btn-delete"><i
                            class="mdi mdi-delete"></i></a> --}}
                      </div>
                    </div>
                  </td>

                  {{-- <form action="/matrices/{{ $value->id }}" id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                  </form> --}}
                  @endforeach

                </tr>
                @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Code</th>
                  <th>Alternative</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>{{ $criterias[$i]->name }}</th>

                    @endfor
                </tr>
              </tfoot>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(function () {
    $('.btn-delete').on('click', function () {
      Swal.fire({
        title: 'Delete Matrix!',
        text: "Are you sure you want to delete this matrix value?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: '<i class="fa fa-times"></i>&nbsp; Cancel',
        confirmButtonText: '<i class="fa fa-check"></i>&nbsp; Yes, Delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form').submit();
        }
      });
    });

    $('.btn-truncate').on('click', function () {
      Swal.fire({
        title: 'Delete All Data!',
        text: "Are you sure you want to delete all data in this matrix?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: '<i class="fa fa-times"></i>&nbsp; Nope! I Change My Mind!',
        confirmButtonText: '<i class="fa fa-check"></i>&nbsp; Yep! Delete Them All!'
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('truncate-form').submit();
        }
      });
    });
  });
</script>
@endsection