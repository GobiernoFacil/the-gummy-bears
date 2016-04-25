        <div id="planning" class="container_info hide">
          <div class="row divider">
            <div class="col-sm-12">
              <p class="title_section">Etapa: Planeación</p>
              <h1>{{ $elcontrato->planning->project }}</h1>
              <h2>{{ $ocid }}</h2>
            </div>
          </div>
          <div class="row divider">
            <div class="col-sm-6">
              <p class="title_section">PRESUPUESTO ({{ $elcontrato->planning->currency }})</p>
              <h2 class="amount"><span>$</span>{{ number_format($elcontrato->planning->amount,2,'.',',')}}</h2>
            </div>
            <div class="col-sm-6">
              <p class="title_section">Fecha</p>
              <?php $time_planning = strtotime($elcontrato->date);?>
              <p>{{ date('d/m/Y',$time_planning)}} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <p class="title_section">COMPRADOR</p>
              <p><a href="{{ url('dependencia/'. $elcontrato->buyer->id ) }}">{{ !empty($elcontrato->buyer->name) ? $elcontrato->buyer->name : ''}}</a></p>
            </div>
          </div>
        </div>
