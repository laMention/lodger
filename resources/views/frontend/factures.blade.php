@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Factures locataires</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table">
            <caption class="ms-4">
              Mes factures
            </caption>
            <thead>
              <tr>
                <th>N°</th>
                <th>Description</th>
                <th>Fichier</th>
                <th>Date génération</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <b>#fact_loc_mois_dec_2022 </b>
                 
                </td>
                
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Mois de juillet 2022</strong></td>
                <td>
                  <a href="{{url('/detail-facture')}}" class="text-danger"><i class="iconify-inline text-danger" data-icon="bi:file-earmark-pdf-fill"></i>fact_loc_000505072022</a>
                </td>
                <td>28-07-2022 à 10:10:30</td>
                <td><span class="badge bg-primary me-1">Paiement en attente</span></td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{url('/detail-facture')}}"
                        ><i class="iconify" data-icon="octicon:eye-16"></i> Détails</a
                      >
                      <!-- <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-1"></i> Renvoyé</a
                      > -->
                      <!-- <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-1"></i> Delete</a
                      > -->
                    </div>
                  </div>
                </td>
              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- <div class="buy-now">
      <a href="{{url('/nouvel-appart')}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter</font></font></a>
    </div> -->

  @stop