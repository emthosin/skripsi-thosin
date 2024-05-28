@extends('layouts.main')

@section('content')
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-12 d-flex no-block align-items-center">
      <h4 class="page-title">Calculation</h4>
      <div class="ml-auto text-right">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/matrices">Matrix</a></li>
            <li class="breadcrumb-item active" aria-current="page">Calculation CRITIC</li>
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
          <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">There are two steps, which are:</h4>
            <p>1. Weighting the criterias using MEREC and CRITIC methods</p>
            <a href="/countMerec" class="btn btn-info"><i class="mdi mdi-calculator"></i> MEREC</a>
            <a href="/countCritic" class="btn btn-info"><i class="mdi mdi-calculator"></i> CRITIC</a>
            </p>
            <p>2. Ranking the alternatives using MOORA methods</p>
            <a href="/countMoora" class="btn btn-info"><i class="mdi mdi-calculator"></i> MOORA</a>
          </div>
        </div> 

<!-- BEGINNING OF CRITIC -->

<div class="card-body">
          <h5 class="card-title mb-3"><strong>Criteria Importance Through Inter-Criteria Correlation (CRITIC)</strong></h5>
          <h5 class="card-title mb-3">2.1. Decision Matrix</h5>
            <div class="table-responsive mt-3">
              <table id="critic_1" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Alternatives</th>

                    @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                      @endfor

                  </tr>
                </thead>
                <tbody>

                  @php
                  $keys = array_keys($matrix)
                  @endphp

                  @foreach ($keys as $key)
                  <tr>
                    <td>A{{ $loop->iteration }}</td>
                    @foreach ($matrix[$key] as $value)
                    <td>{{ round($value, 4) }}</td>
                    @endforeach
                  </tr>
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>Alternatives</th>

                    @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                      @endfor

                  </tr>
                </tfoot>
              </table>
            </div>

          </div>
          <div class="card-body">
            <h5 class="card-title mb-3">2.2. Normalization of the Decision Matrix</h5>
            <div class="table-responsive mt-3">
              <table id="critic_2" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Alternatives</th>

                    @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                      @endfor

                  </tr>
                </thead>
                <tbody>

                  @php
                  $keys = array_keys($normalisasiCritic)
                  @endphp

                  @foreach ($keys as $key)
                  <tr>
                    <td>A{{ $loop->iteration }}</td>
                    @foreach ($normalisasiCritic[$key] as $value)
                    <td>{{ round($value, 4) }}</td>
                    @endforeach
                  </tr>
                  @endforeach

                </tbody>
                <tfoot>
                  <tr>
                    <th>Alternatives</th>

                    @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                      @endfor

                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

          <!-- STANDARD DEVIATION START -->
          <!-- <div class="card-body">
          <h5 class="card-title mb-3">MEAN</h5>
          <div class="table-responsive mt-3">
            <table id="sum_pow" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                <tr>
                  @foreach ($columnMeans as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">DISTANCE</h5>
          <div class="table-responsive mt-3">
            <table id="pow" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatif</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($distance)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($distance[$key] as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>
                @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>Alternatif</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">SUM</h5>
          <div class="table-responsive mt-3">
            <table id="sum_pow" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                <tr>
                  @foreach ($sumDis as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">DIVIDE</h5>
          <div class="table-responsive mt-3">
            <table id="sum_pow" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                <tr>
                  @foreach ($divided as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div> -->
          <!-- STANDARD DEVIATION FINISH -->

          <div class="card-body">
          <h5 class="card-title mb-3">2.3. Calculation of Standard Deviation for Each Criteria</h5>
          <div class="table-responsive mt-3">
            <table id="critic_3" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                <tr>
                  @foreach ($stdDev as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">2.4. Determine the Symmetric Matrix</h5>
          <div class="table-responsive mt-3">
            <table id="critic_4" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Criterias</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

              @php
                  $keys = array_keys($correl)
                  @endphp

                  @foreach ($keys as $key)
                  <tr>
                    <td>C{{ $loop->iteration }}</td>
                    @foreach ($correl[$key] as $value)
                    <td>{{ round($value, 4) }}</td>
                    @endforeach
                  </tr>
                  @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>Criterias</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>
        
        <div class="card-body">
          <h5 class="card-title mb-3">2.5. Measure of the Conflict Created by Criterion</h5>
          <div class="table-responsive mt-3">
            <table id="critic_5" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Criterias</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

              @php
                  $keys = array_keys($conflicCreated)
                  @endphp

                  @foreach ($keys as $key)
                  <tr>
                    <td>C{{ $loop->iteration }}</td>
                    @foreach ($conflicCreated[$key] as $value)
                    <td>{{ round($value, 4) }}</td>
                    @endforeach
                  </tr>
                  @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>Criterias</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">2.6. Estimation of Criterion information (Cj)</h5>
          <div class="table-responsive mt-3">
            <table id="critic_6" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach ($est as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor
                </tr>
              </tfoot>
            </table>
          </div>

        </div>
        <div class="card-body">
          <h5 class="card-title mb-3">2.7. Determining the Objective Weights (Wj)</h5>
          <div class="table-responsive mt-3">
            <table id="critic_7" class="table table-striped table-bordered">
              <thead>
                <tr>

                  <td>Criterias</td>
                  <td>Weight</td>
<!--                  <td>Rank</td> -->

                </tr>
              </thead>
              <tbody>

              @php
                    $keys = array_keys($weightCritic)
                    @endphp

                    @foreach ($keys as $key)
                    <tr>
                      <td>C{{ $key }}</td>
                      <td>{{ round($weightCritic[$key], 4) }}</td> 
<!--                      <td>{{ $loop->iteration }}</td>v-->
                    </tr>
                    @endforeach

              </tbody>
              <tfoot>
                <tr>

                  <td>Criterias</td>
                  <td>Weight</td>
<!--                  <td>Rank</td> -->

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <!-- END OF CRITIC -->

        <div class="card-body">
          <a href="/matrices" class="btn btn-danger"><i class="mdi mdi-arrow-left-bold"></i> Back</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('#critic_1').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_2').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_3').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_4').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_5').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_6').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_7').DataTable({
    'ordering': true,
    'paging': false
  });
  
  let listAlternative = []
  rank.forEach(e => {
    listAlternative.push({
      'code': e.previousElementSibling.innerHTML,
      'value': e.innerHTML
    })
  });

  let listAlternativeMerec = []
  rankMerecMoora.forEach(e => {
    listAlternativeMerec.push({
      'code': e.previousElementSibling.innerHTML,
      'value': e.innerHTML
    })
  });

  let dbAlternative = []
  $.get('/matrices/alternatives', function (data) {
    data.alternatives.forEach(e => {
      dbAlternative.push({
        'key': e.id,
        'code': e.code,
        'name': e.name
      })
    });

    listAlternative.forEach(e => {
      dbAlternative.forEach(el => {
        if (e.code == el.code) {
          e.key = el.key
          e.name = el.name
        }
      });
    });

    listAlternativeMerec.forEach(e => {
      dbAlternative.forEach(el => {
        if (e.code == el.code) {
          e.key = el.key
          e.name = el.name
        }
      });
    });


    const tableBody = document.querySelector('#table-body')
    listAlternative.forEach(e => {
      tableBody.innerHTML += `
        <tr>
          <td>A${e.key}</td>
          <td>${e.name}</td>
          <td>${e.value}</td>
        </tr>
      `
    });

  });
</script>
@endsection