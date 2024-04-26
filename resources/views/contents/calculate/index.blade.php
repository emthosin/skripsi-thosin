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
            <li class="breadcrumb-item active" aria-current="page">Calculation</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- BEGINNING OF MEREC -->

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
        <h5 class="card-title mb-3"><strong>Method Based on the Removal Effects of Criteria (MEREC)</strong></h5>
 
        <h5 class="card-title mb-3">1.1. Decision Matrix</h5>
          <div class="table-responsive mt-3">
            <table id="merec_1" class="table table-striped table-bordered">
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
          <h5 class="card-title mb-3">1.2. Normalization of the Decision Matrix</h5>
          <div class="table-responsive mt-3">
            <table id="merec_2" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatives</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($normalisasi)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($normalisasi[$key] as $value)
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

        <!-- THIS IS WHERE IT STARTS -->
        <!-- <div class="card-body">
          <h5 class="card-title mb-3">LOG VALUES</h5>
          <div class="table-responsive mt-3">
            <table id="normalisasi" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatif</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($logValues)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($logValues[$key] as $value)
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
          <h5 class="card-title mb-3">ABS VALUES</h5>
          <div class="table-responsive mt-3">
            <table id="normalisasi" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatif</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($absValues)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($absValues[$key] as $value)
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
          <h5 class="card-title mb-3">SUM VALUES</h5>
          <div class="table-responsive mt-3">
            <table id="sum_normalisasi" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($alternatives); $i++) <th>A{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                <tr>
                  @foreach ($sumValues as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($alternatives); $i++) <th>A{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>   -->
        <!-- THIS IS WHERE IT'S DONE -->
        <div class="card-body">
          <h5 class="card-title mb-3">1.3. Calculation of Overall Performance of Alternatives (Si)</h5>
          <div class="table-responsive mt-3">
            <table id="merec_3" class="table table-striped table-bordered">
              <thead>
                <tr>

                  @for ($i = 0; $i < count($alternatives); $i++) <th>A{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                <tr>
                  @foreach ($sumAbsLogCriteria as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>

              </tbody>
              <tfoot>
                <tr>

                  @for ($i = 0; $i < count($alternatives); $i++) <th>A{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">1.4. Calculation of Performance of Alternatives by Removing Each Attribute (Sij')</h5>
          <div class="table-responsive mt-3">
            <table id="merec_4" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatives</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($sumAbsLogCriterias)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($sumAbsLogCriterias[$key] as $value)
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
          <h5 class="card-title mb-3">1.5. Calculation of Removal Effect (Ej)</h5>
          <div class="table-responsive mt-3">
            <table id="merec_5" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatives</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($removalEffect)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($removalEffect[$key] as $value)
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
          <h5 class="card-title mb-3">1.6. Estimate the final Weights (Wj)</h5>
          <div class="table-responsive mt-3">
            <table id="merec_6" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td>Criterias</td>
                  <td>Weight</td>
                  <td>Rank</td>
                </tr>
              </thead>
              <tbody>

              @php
                    $keys = array_keys($weight)
                    @endphp

                    @foreach ($keys as $key)
                    <tr>
                      <td>C{{ $key }}</td>
                      <td>{{ round($weight[$key], 4) }}</td>
                      <td>{{ $loop->iteration }}</td>
                    </tr>
                    @endforeach

              </tbody>

              
              <tfoot>
                <tr>
                  <td>Criterias</td>
                  <td>Weight</td>
                  <td>Rank</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

<!-- END OF MEREC -->
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
                  <td>Rank</td>

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
                      <td>{{ $loop->iteration }}</td>
                    </tr>
                    @endforeach

              </tbody>
              <tfoot>
                <tr>

                  <td>Criterias</td>
                  <td>Weight</td>
                  <td>Rank</td>

                </tr>
              </tfoot>
            </table>
          </div>

        </div>
        <!-- END OF CRITIC -->

        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card-body">
              <h5 class="card-title mb-3"><strong>WEIGHT COMPARISON</strong></h5>
              <h5 class="card-title mb-3">MEREC Weight</h5>
              <div class="table-responsive mt-3">
                <table id="weight_1" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>Criterias</td>
                      <td>Weight</td>
                      <td>Rank</td>
                    </tr>
                  </thead>
                  <tbody>

                    @php
                    $keys = array_keys($weight)
                    @endphp

                    @foreach ($keys as $key)
                    <tr>
                      <td id="key">C{{ $key }}</td>
                      <td id="rank-merec">{{ round($weight[$key], 4) }}</td>
                      <td>{{ $loop->iteration }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <td>Criterias</td>
                      <td>Weight</td>
                      <td>Rank</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card-body">
              <h5 class="card-title mb-3"><strong>&nbsp;</strong></h5>
              <h5 class="card-title mb-3">CRITIC Weight</h5>
              <div class="table-responsive mt-3">
                <table id="weight_2" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>Criterias</td>
                      <td>Weight</td>
                      <td>Rank</td>
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
                      <td>{{ $loop->iteration }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <td>Criterias</td>
                      <td>Weight</td>
                      <td>Rank</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
        </div>

        <!-- BEGINNING OF MOORA -->
        <div class="card-body">
          <h5 class="card-title mb-3"><strong>Method Based on the Ratio Analysis (MOORA)</strong></h5>
          <h5 class="card-title mb-3">3.1. Decision Matrix</h5>
          <div class="table-responsive mt-3">
            <table id="moora_1" class="table table-striped table-bordered">
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
                  <th>Alternaties</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">3.2. Normalization of the Decision Matrix</h5>
          <div class="table-responsive mt-3">
            <table id="moora_2" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatives</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($normalisasiMoora)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($normalisasiMoora[$key] as $value)
                  <td>{{ round($value, 4) }}</td>
                  @endforeach
                </tr>
                @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>Alternaties</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </tfoot>
            </table>
          </div>

        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">3.3. Weighting Normalized Decision Matrix</h5>
          <h5 class="card-title mb-3">Weighting Using MEREC</h5>
          <div class="table-responsive mt-3">
            <table id="moora_3" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatives</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($merecWeighted)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($merecWeighted[$key] as $value)
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
          <h5 class="card-title mb-3">Weighting Using CRITIC</h5>
          <div class="table-responsive mt-3">
            <table id="moora_4" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Alternatives</th>

                  @for ($i = 0; $i < count($criterias); $i++) <th>C{{ $i + 1 }}</th>

                    @endfor

                </tr>
              </thead>
              <tbody>

                @php
                $keys = array_keys($criticWeighted)
                @endphp

                @foreach ($keys as $key)
                <tr>
                  <td>A{{ $loop->iteration }}</td>
                  @foreach ($criticWeighted[$key] as $value)
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

        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card-body">
              <h5 class="card-title mb-3">Final Value MEREC-MOORA</h5>
              <div class="table-responsive mt-3">
                <table id="merec_moora"class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>Alternatives</td>
                      <td>Score</td>
                      <td>Rank</td>
                    </tr>
                  </thead>
                  <tbody>

                    @php
                    $keys = array_keys($merecRank)
                    @endphp

                    @foreach ($keys as $key)
                    <tr>
                      <td id="key">A{{ $key }}</td>
                      <td id="rank-merec-moora">{{ round($merecRank[$key], 4) }}</td>
                      <td>{{ $loop->iteration }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <td>Alternatives</td>
                      <td>Score</td>
                      <td>Rank</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="card-body">
              <h5 class="card-title mb-3">Final Value CRITIC-MOORA</h5>
              <div class="table-responsive mt-3">
                <table id="critic_moora" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>Alternatives</td>
                      <td>Score</td>
                      <td>Rank</td>
                    </tr>
                  </thead>
                  <tbody>

                    @php
                    $keys = array_keys($criticRank)
                    @endphp

                    @foreach ($keys as $key)
                    <tr>
                      <td id="key">A{{ $key }}</td>
                      <td id="rank">{{ round($criticRank[$key], 4) }}</td>
                      <td>{{ $loop->iteration }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <td>Alternatives</td>
                      <td>Score</td>
                      <td>Rank</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="card-body">
          <h5 class="card-title mb-3"><strong>RANKS COMPARISON</strong></h5>
            <h5 class="card-title mb-3">MEREC-MOORA Rank</h5>
            <div class="table-responsive mt-3">
              <table id="merec_moora_1" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <td>Code</td>
                    <td>Alternatives</td>
                    <td>Score</td>
                  </tr>
                </thead>
                <tbody id="table-body-merec-moora">
                </tbody>
                <tfoot>
                  <tr>
                    <td>Code</td>
                    <td>Alternatives</td>
                    <td>Score</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

          <div class="card-body">
              <h5 class="card-title mb-3"><strong>&nbsp;</strong></h5>
            <h5 class="card-title mb-3">CRITIC-MOORA Rank</h5>
            <div class="table-responsive mt-3">
              <table id="critic_moora_1" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <td>Code</td>
                    <td>Alternatives</td>
                    <td>Score</td>
                  </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
                <tfoot>
                  <tr>
                    <td>Code</td>
                    <td>Alternatives</td>
                    <td>Score</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        <!-- <div class="card-body">
          <h5 class="card-title mb-3">Perankingan SMK</h5>
          <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td>Alternatif</td>
                  <td>Nama Alternatif</td>
                  <td>θ</td>
                </tr>
              </thead>
              <tbody id="table-body-smk">
              </tbody>
              <tfoot>
                <tr>
                  <td>Alternatif</td>
                  <td>Nama Alternatif</td>
                  <td>θ</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">Perankingan MA</h5>
          <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td>Alternatif</td>
                  <td>Nama Alternatif</td>
                  <td>θ</td>
                </tr>
              </thead>
              <tbody id="table-body-ma">
              </tbody>
              <tfoot>
                <tr>
                  <td>Alternatif</td>
                  <td>Nama Alternatif</td>
                  <td>θ</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div> -->

        <!-- <div class="card-body">
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Conclusion :</h4>
            <p>Sekolah yang terpilih menjadi sekolah terbaik berdasarkan beberapa kriteria tertentu adalah
              <b id="firstRankSma"></b> untuk SMA, <b id="firstRankSmk"></b> untuk SMK, dan <b id="firstRankMa"></b>
              untuk MA.
            </p>
            </p>
            <hr>
            <p class="mb-3"><b>Urutan Ranking 1 - 3 :</b></p>
            <p class="m-0" id="first"></p>
            <p class="m-0" id="second"></p>
            <p class="m-0" id="third"></p>
            <hr>
            <p class="mb-3"><b>Urutan Ranking 1 - 3 SMA :</b></p>
            <p class="m-0" id="first-sma"></p>
            <p class="m-0" id="second-sma"></p>
            <p class="m-0" id="third-sma"></p>
            <hr>
            <p class="mb-3"><b>Urutan Ranking 1 - 3 SMK :</b></p>
            <p class="m-0" id="first-smk"></p>
            <p class="m-0" id="second-smk"></p>
            <p class="m-0" id="third-smk"></p>
            <hr>
            <p class="mb-3"><b>Urutan Ranking 1 - 3 MA :</b></p>
            <p class="m-0" id="first-ma"></p>
            <p class="m-0" id="second-ma"></p>
            <p class="m-0" id="third-ma"></p>
          </div>
        </div> -->

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
  $('#merec_1').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#merec_2').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#merec_3').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#merec_4').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#merec_5').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#merec_6').DataTable({
    'ordering': false,
    'paging': false
  });
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
    'ordering': false,
    'paging': false
  });
  $('#weight_1').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#weight_2').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#moora_1').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#moora_2').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#moora_3').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#moora_4').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#merec_moora').DataTable({
    'ordering': false,
    'paging': false
  });
  $('#critic_moora').DataTable({
    'ordering': false,
    'paging': false
  });

  const rank = document.querySelectorAll('#rank')
  const rankMerecMoora = document.querySelectorAll('#rank-merec-moora')
  const firstRankSma = document.querySelector('#firstRankSma')
  const firstRankSmk = document.querySelector('#firstRankSmk')
  const firstRankMa = document.querySelector('#firstRankMa')
  const first = document.querySelector('#first')
  const second = document.querySelector('#second')
  const third = document.querySelector('#third')
  const firstSma = document.querySelector('#first-sma')
  const secondSma = document.querySelector('#second-sma')
  const thirdSma = document.querySelector('#third-sma')
  const firstSmk = document.querySelector('#first-smk')
  const secondSmk = document.querySelector('#second-smk')
  const thirdSmk = document.querySelector('#third-smk')
  const firstMa = document.querySelector('#first-ma')
  const secondMa = document.querySelector('#second-ma')
  const thirdMa = document.querySelector('#third-ma')

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

    let listAlternativeSma = listAlternative.filter(e => e.name.includes('SMA'))
    let listAlternativeSmk = listAlternative.filter(e => e.name.includes('SMK') || e.name.includes('SMTK'))
    let listAlternativeMa = listAlternative.filter(e => e.name.includes(' MA'))

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

    const tableBodyMerecMoora = document.querySelector('#table-body-merec-moora')
    listAlternativeMerec.forEach(e => {
      tableBodyMerecMoora.innerHTML += `
        <tr>
          <td>A${e.key}</td>
          <td>${e.name}</td>
          <td>${e.value}</td>
        </tr>
      `
    });

    const tableBodySmk = document.querySelector('#table-body-smk')
    listAlternativeSmk.forEach(e => {
      tableBodySmk.innerHTML += `
        <tr>
          <td>A${e.key}</td>
          <td>${e.name}</td>
          <td>${e.value}</td>
        </tr>
      `
    });

    const tableBodyMa = document.querySelector('#table-body-ma')
    listAlternativeMa.forEach(e => {
      tableBodyMa.innerHTML += `
        <tr>
          <td>A${e.key}</td>
          <td>${e.name}</td>
          <td>${e.value}</td>
        </tr>
      `
    });

    firstRankSma.innerHTML = listAlternativeSma[0].name
    firstRankSmk.innerHTML = listAlternativeSmk[0].name
    firstRankMa.innerHTML = listAlternativeMa[0].name
    first.innerHTML = `1. ${listAlternative[0].name} (${listAlternative[0].value})`
    second.innerHTML = `2. ${listAlternative[1].name} (${listAlternative[1].value})`
    third.innerHTML = `3. ${listAlternative[2].name} (${listAlternative[2].value})`
    firstSma.innerHTML = `1. ${listAlternativeSma[0].name} (${listAlternativeSma[0].value})`
    secondSma.innerHTML = `2. ${listAlternativeSma[1].name} (${listAlternativeSma[1].value})`
    thirdSma.innerHTML = `3. ${listAlternativeSma[2].name} (${listAlternativeSma[2].value})`
    firstSmk.innerHTML = `1. ${listAlternativeSmk[0].name} (${listAlternativeSmk[0].value})`
    secondSmk.innerHTML = `2. ${listAlternativeSmk[1].name} (${listAlternativeSmk[1].value})`
    thirdSmk.innerHTML = `3. ${listAlternativeSmk[2].name} (${listAlternativeSmk[2].value})`
    firstMa.innerHTML = `1. ${listAlternativeMa[0].name} (${listAlternativeMa[0].value})`
    secondMa.innerHTML = `2. ${listAlternativeMa[1].name} (${listAlternativeMa[1].value})`
    thirdMa.innerHTML = `3. ${listAlternativeMa[2].name} (${listAlternativeMa[2].value})`
  });
</script>
@endsection