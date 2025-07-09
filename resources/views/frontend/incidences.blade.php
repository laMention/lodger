@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Incidences / </span>Incidents</h4>
      <hr class="my-5" />

      

      <div class="row">
        <div class="col-md-12">
          <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table">
            <caption class="ms-4">
              Liste des incidents
            </caption>
            <thead>
              <tr>
                <th>#</th>
                <th>Sujet</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               
                <td>1</td>
                <td>Plomberie</td>
                <td>Lorem ipsum</td>
                <td>10-08-2022 10:00</td>
                
                <td><span class="badge bg-label-primary me-1">En attente</span></td>
                <td>
                  <div class="dropdown">
                   
                   

                    <button type="button" class="btn btn-icon btn-outline-danger" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<p>Etes-vous sûr de vouloir supprimer ?<br> </p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-outline-secondary'>Non</button><button type='button' class='btn btn-sm btn-primary'>Continuer</button></div>" title="" data-bs-original-title="Supprimer cet incident" aria-describedby="popover359940">
                    <!-- <span class="iconify" data-icon="clarity:close-line"></span> -->
                      <span class="tf-icons bx bx-trash"></span>
                    </button>


                  </div>
                </td>


              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
        </div>
      </div>
    </div>
    <div class="buy-now">
      <a href="{{url('/locataire/incidences/nouveau')}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Déclarer un incident</font></font></a>
    </div>

  @stop