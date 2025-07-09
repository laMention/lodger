@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Paiement / </span>Moyens de paiement</h4>

      <div class="row">
        <div class="col-md-12">
         <!-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-credit-card me-1"></i> Ajouter un moyen de paiement</a>
            </li>
            
          </ul> -->
          <div class="mb-4">
            <div class="alert alert-warning" role="alert"><i class="bx bx-error"> </i> L'enregistrement d'un moyen de paiement est obligatoire si vous utilisez le renouvellement automatique. Vous pouvez le modifier à tout moment. Si vous ne disposez pas d'un renouvellement automatique et que vous souhaitez supprimer votre moyen de paiement, veuillez contacter notre équipe d'assistance à la clientèle en créant un ticket.</div>
            <div class="alert alert-primary" role="alert">

              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAVtJREFUSEu9leExRTEQhb9XCSpABZRABXSASlABKkAHVIAOqIT5ZpI3m7x7k5vh2Zn8yL2bc3ZPdjcrtmyrLeOzhOAcOAIO0jKm97SegOdWkC2CE+Aa2O1k+QlcAZJt2BzBDXCRvL8A9y8paj+bzTFwCewkP30kKmyKIIJ7wH3LJDFT7TaRrv1rAmV5TH8PQ8S9WjCjt+R0GuWqCdTTlOci/04gU5nnTMTYyxFFR6vlDlDzuYttEYiZA1xnEQnugbNG9D2Z/J+zeAAMuOgDa3sfGNG+Js13IZY4BUEvff2HfaJEw4dnNCtwIsESiXpBZIk+8lgZveQeQfOSc5MVdVzJ0CNolmms4980WtFH/z4qzCIOOzV1gP3ZsMtAkURd3b9W49pHyADyWNmYpHWj1VF66QLneT+XhZpLNPTgRDCJXNa4o0Szzu0bQSeBp6bpkmE27LPk0R8GjQd+APhwVhmesgEPAAAAAElFTkSuQmCC"/>
              Besoin d'aide pour vos renouvellements ? <b>En savoir plus</b> </div>
          </div>

          <div class="card mb-4">
            <div class="mb-3 mx-4 my-3">
              Lorsque vous enregistrez un moyen de paiement, vous autorisez le système à le conserver afin de faciliter le règlement de vos abonnements futurs. Le moyen de paiement que vous enregistrez en tant que moyen de paiement « par défaut » est utilisé automatiquement à chaque échéance, pour le paiement de vos services en renouvellement automatique. Vous serez notifié avant chaque nouvelle échéance de paiement. Vous pouvez à tout moment modifier, supprimer ou ajouter des moyens de paiement en utilisant l’interface ci-dessous. Pour pouvoir utiliser des services en renouvellement automatique ou en paiement à l’usage, vous devez impérativement disposer d’au moins un moyen de paiement valide enregistré.
            </div>
            <!-- Account -->
            <div class="card-body">
              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Type de paiement</th>
                      <th>Compte</th>
                      <th>Date d'expiration</th>
                      <th>Description</th>
                      <th>Moyen de paiement par défaut</th>
                      <th>Etat</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <tr>
                      
                      <td>Carte bancaire</td>
                      <td>
                        XXXXXXXXXXXX3302
                      </td>
                      <td>31/05/2026</td>
                      <td>-</td>

                      <td><span class="badge bg-label-success me-1">Oui</span></td>
                      <td>Validé</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"
                              > <span class="bx bx-edit-alt" ></span>Modifier</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              > <span class="iconify-inline" data-icon="fa-solid:pencil"></span>Définir ce moyen de paiement par défaut</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              ><span class="bx bx-trash"></span> Supprimer ce moyen de paiement</a
                            >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      
                      <td>Orange</td>
                      <td>
                       XXXXXXXX32
                      </td>
                      <td>-</td>
                      <td>-</td>

                      <td><span class="badge bg-label-danger me-1">Non</span></td>
                      <td>Validé</td>
                      
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"
                              > <span class="bx bx-edit-alt"></span>Modifier</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              > <span class="iconify-inline" data-icon="fa-solid:pencil"></span>Définir ce moyen de paiement par défaut</a
                            >
                            <a class="dropdown-item" href="javascript:void(0);"
                              ><span class="bx bx-trash"></span> Supprimer ce moyen de paiement</a
                            >
                          </div>
                        </div>
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
            </div>
            
            <!-- /Account -->
          </div>
          
        </div>
      </div>
    </div>
    <div class="buy-now">
      <a href="{{url('/locataire/paiements/moyens-paiement/ajouter')}}" class="btn btn-danger btn-buy-now"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><i class="bx bx-credit-card me-1"></i> Ajouter un moyen de paiement</font></font></a>
    </div>

  @stop