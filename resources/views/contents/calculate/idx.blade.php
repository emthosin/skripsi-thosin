<div class="col-lg-6 col-md-12">
            <div class="card-body">
              <h5 class="card-title mb-3">Perankingan</h5>
              <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <td>Alternatif</td>
                      <td>θ</td>
                    </tr>
                  </thead>
                  <tbody>

                    @php
                    $keys = array_keys($sumPsiRank)
                    @endphp

                    @foreach ($keys as $key)
                    <tr>
                      <td id="key">A{{ $key }}</td>
                      <td id="rank">{{ round($sumPsiRank[$key], 4) }}</td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <td>Alternatif</td>
                      <td>θ</td>
                    </tr>
                  </tfoot>
                </table>
              </div>

            </div>
          </div>
        </div>

        <div class="card-body">
          <h5 class="card-title mb-3">Perankingan</h5>
          <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td>Alternatif</td>
                  <td>Nama Alternatif</td>
                  <td>θ</td>
                </tr>
              </thead>
              <tbody id="table-body">
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