<div class="modal fade" id="payer{{$factures->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel3">{{__('Loyer de '.$periode[0].' à '.$periode[1])}}</h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <form id="savePaiement" action="{{-- route('paiementloyer.store',[config('app.locale')]) --}}" enctype="multipart/form-data" method="post">
                          @csrf
                          <div class="modal-body">
                            <input type="hidden" name="reference_facture" value="{{$factures->reference}}">
                            <input type="hidden" name="facture_id" value="{{$factures->id}}">
                            <input type="hidden" name="appartement_id" value="{{$factures->location->appartement->id}}">
                            <input type="hidden" name="locataire_id" value="{{$factures->location->locataire->id}}">
                            <input type="hidden" name="location_id" value="{{$factures->location->id}}">
                            <input type="hidden" name="periode" value="{{$periode[0].' à '.$periode[1]}}">
                            <input type="hidden" name="agence_id" value="{{auth()->user()->agence->id}}">
                            <input type="hidden" name="montant_restant" value="{{$factures->location->appartement->montant_loyer - $totalpaiement}}">
                            <input type="hidden" name="montant_loyer" value="{{$factures->location->appartement->montant_loyer}}">
                            <div class="row g-2">
                              <div class="col mb-3">
                                <label for="num_facture" class="form-label">N°</label>
                                <input type="text" id="num_facture" class="form-control" value="{{$factures->reference}}" disabled>
                              </div>
                              <div class="col mb-3">
                                <label for="periode" class="form-label">PERIODE</label>
                                <input type="text" id="periode" class="form-control" value="{{$periode[0]}}" disabled>
                              </div>
                              <div class="col mb-3">
                                <label for="locataire" class="form-label">LOCATAIRE</label>
                                <input type="text" id="locataire" class="form-control" value="{{ucwords($factures->location->locataire->name.' '.$factures->location->locataire->lastname)}}" disabled>
                              </div>
                            </div>
                            <div class="row g-2">
                              <div class="col mb-0">
                                <label for="bien" class="form-label">BIEN</label>
                                <input type="text" name="bien" id="bien" class="form-control"
                                  @if($factures->location->appartement->categorie == 3) 
                                    value="{!! $appart->getCategorie($factures->location->appartement->categorie).' '.$factures->location->appartement->type_commerce !!}" @else  value="{!! $appart->getCategorie($factures->location->appartement->categorie).' '.$factures->location->appartement->libelle !!}" @endif
                                  @if($factures->location->appartement->categorie == 1)

                                    value="{!! $appart->getCategorie($factures->location->appartement->categorie).' '.$factures->location->appartement->libelle.' '.$factures->location->appartement->num_appart.' '.$factures->location->appartement->niveau !!}"

                                @elseif($factures->location->appartement->categorie == 3)
                                  value="{!! $appart->getCategorie($factures->location->appartement->categorie).' '.$factures->location->appartement->libelle.' '.$factures->location->appartement->type_commerce !!}"

                                @endif " disabled >
                              </div>
                              <div class="col mb-0">
                                <label for="loyer" class="form-label">LOYER</label>
                                <input type="text" id="loyer" class="form-control" value="{{number_format($factures->location->appartement->montant_loyer,'0','.',' ').' '.$factures->location->appartement->devise}} " disabled>
                              </div>
                              <div class="col mb-0">
                                <label for="loyer" class="form-label">ECHEANCE</label>
                                <input type="text" id="loyer" class="form-control" value="{{date_format(new \DateTime($factures->next_date_echeance),'d-m-Y')}}" disabled>
                              </div>
                              <div class="col mb-0">
                                <label for="proprietaire" class="form-label">PROPRIETAIRE</label>
                                <input type="text" id="proprietaire" class="form-control" value="{{ucwords($factures->location->appartement->proprietaire->name.' '.$factures->location->appartement->proprietaire->lastname)}}" disabled>
                              </div>
                            </div>
                            <hr>
                            <div class="row g-2">
                              <div class="col mb-3">
                                <label for="date_paiement" class="form-label">DATE PAIEMENT</label>
                                <input type="date" id="date_paiement" class="form-control" placeholder="Entrer la date du paiement" name="date_paiement" required>
                                <span class="mt-2 date_feedback"></span>
                              </div>
                              <div class="col mb-3">
                                <label for="montant_paiement" class="form-label">MONTANT VERSE</label>
                                <input type="number" id="montant_paiement" class="form-control" placeholder="Ex: 100000" name="montant_paiement" required>
                                <span class="mt-2 montant_feedback"></span>

                              </div>
                            </div>
                            <div class="row g-2">
                              <div class="col mb-0">
                                <label for="mode_paiement" class="form-label">MODE PAIEMENT</label>
                                <select class="form-select" id="mode_paiement" name="mode_paiement" aria-label="Default select example" required>
                                  <option selected value="" >{{__('Choisir')}}</option>
                                  <option value="MOBILE MONEY">MOBILE MONEY</option>
                                  <option value="ESPECES">ESPECES</option>
                                  <option value="CHEQUE">CHEQUE</option>
                                  <option value="VIREMENT BANCAIRE">VIREMENT BANCAIRE</option>
                                </select>
                                <span class="mt-2 mode_feedback"></span>

                              </div>

                              <div class="col mb-0">
                                <label for="passerelle" class="form-label">PASSERELLE</label>
                                <input type="text" id="passerelle" name="passerelle" class="form-control" placeholder="Ex: ORANGE">
                              </div>
                              <div class="col mb-0 id_transaction" >
                                <label for="id_transaction" class="form-label">ID TRANSACTION</label>
                                <input type="text" id="id_transaction" name="id_transaction" class="form-control" >
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                              Annuler
                            </button>
                            <button type="submit" class="btn btn-success save_payment">Enregistrer</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>