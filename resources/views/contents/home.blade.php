@extends('layouts.main')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Dashboard</h4>
      <div class="ml-auto text-right">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <!-- Column -->
    {{-- <div class="col-md-12 col-lg-12">
      <div class="card card-hover">
        <div class="box bg-cyan text-center">
          <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
          <h6 class="text-white">Dashboard</h6>
        </div>
      </div>
    </div> --}}
    <div class="col-md-12 col-lg-6">
      <div class="card card-hover">
        <div class="box bg-info text-center">
          <div class="d-flex align-items-center justify-content-center p-3">
            <h1 class="font-light text-white"><i class="mdi mdi-target"></i></h1>
            <div class="ml-5">
              <h6 class="text-white">Alternatives</h6>
              <h4 class="text-white">{{ $alternativeCount }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Column -->
    <div class="col-md-12 col-lg-6">
      <div class="card card-hover">
        <div class="box bg-success text-center">
          <div class="d-flex align-items-center justify-content-center p-3">
            <h1 class="font-light text-white"><i class="mdi mdi-format-list-bulleted"></i></h1>
            <div class="ml-5">
              <h6 class="text-white">Criterias</h6>
              <h4 class="text-white">{{ $criteriaCount }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

 
    <div class="card">
      <div class="card-body">
        <div style="text-align: center;">
          <img src="{{ asset('cw.png') }}" alt="Example Image" style="max-width: 100%;">
        </div>
      </div>
    </div>
    <!-- <div style="text-align: center;">
        <img src="{{ asset('cw.png') }}" alt="Example Image" style="max-width: 100%;">
    </div> -->
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Criterias Convertion</h4>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c1" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">Bed Type (C3)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>Small Single Bed</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>Double Bed</td>
                  <td>2</td>
                </tr>
                <tr>
                  <td>Small Double Bed</td>
                  <td>3</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c2" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">Bedroom Size (C4)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>4m x 2.6m</td>
                  <td>10.4</td>
                </tr>
                <tr>
                  <td>5m x 2.8m</td>
                  <td>14</td>
                </tr>
                <tr>
                  <td>5.2m x 2.7m</td>
                  <td>14.04</td>
                </tr>
                <tr>
                  <td>5m x 3m</td>
                  <td>15</td>
                </tr>
                <tr>
                  <td>5.2m x 2.9m</td>
                  <td>15.08</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c3" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">Bedroom Facilities (C5)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>Desk, handbasin, wardrobe</td>
                  <td>3</td>
                </tr>
                <tr>
                  <td>Desk and chair, wardrobe, bookshelf</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>2 desks and 2 chairs, 2 wardrobes, 2 bookshelves</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Desk and chair, wardrobe, bookshelf, whiteboard</td>
                  <td>5</td>
                </tr>
                <tr>
                  <td>Desk and chair, wardrobe, drawers, lamp</td>
                  <td>5</td>
                </tr>
                <tr>
                  <td>Desk and chair, bin, wardrobe, bookshelf, lamp</td>
                  <td>6</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c4" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">Roomate (C6)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>Yes</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>No</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c4_1" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">Shared Kitchenette (C8)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>Yes</td>
                  <td>1</td>
                </tr>
                <tr>
                  <td>No</td>
                  <td>2</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c4_2" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">On-Site Gym (C12)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>Yes</td>
                  <td>2</td>
                </tr>
                <tr>
                  <td>No</td>
                  <td>1</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive mt-3">
            <table id="keterangan_c5" class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th colspan="2" class="bg-success text-white">Kitchen Facilities (C7)</th>
                </tr>
                <tr>
                  <td>Value</td>
                  <td>Converted</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <td>Microwave/combi oven, fridge/freezer, kettle</td>
                  <td>3</td>
                </tr>
                <tr>
                  <td>Microwave/combi oven, kettle, fridge/freezer, toaster</td>
                  <td>4</td>
                </tr>
                <tr>
                  <td>Oven, microwave, fridge/freezer, kettle, toaster</td>
                  <td>5</td>
                </tr>
                <tr>
                  <td>Microwave/combi oven, kettle, fridge/freezer, toaster, iron and ironing board</td>
                  <td>6</td>
                </tr>
                <tr>
                  <td>Oven, microwave, fridge/freezer, iron and ironing board, kettle</td>
                  <td>6</td>
                </tr>
                <tr>
                  <td>Oven, microwave, fridge/freezer, iron and ironing board, kettle, toaster</td>
                  <td>7</td>
                </tr>
                <tr>
                  <td>Oven, microwave, kettle, fridge/freezer, Iron and ironing board, mop/bucket and vacuum cleaner</td>
                  <td>8</td>
                </tr>
                <tr>
                  <td>Oven, microwave, kettle, fridge/freezer, Toaster, Iron and ironing board, TV/longue area</td>
                  <td>8</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  


  <!-- ============================================================== -->
  <!-- End PAge Content -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Right sidebar -->
  <!-- ============================================================== -->
  <!-- .right-sidebar -->
  <!-- ============================================================== -->
  <!-- End Right sidebar -->
  <!-- ============================================================== -->
</div>
    
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
@endsection

@section('script')
<script>
  $('#keterangan_c1').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#keterangan_c2').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#keterangan_c3').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#keterangan_c4').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#keterangan_c4_1').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#keterangan_c4_2').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#keterangan_c5').DataTable({
    'ordering': false,
    'paging': false
  });
</script>
@endsection