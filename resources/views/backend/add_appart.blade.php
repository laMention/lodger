@extends('backend.partials._template')
  @section('content')
     <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Appartements') }}/</span> {{ __('Ajouter')}}</h4>


      <!-- Basic Layout -->
      <form id="addAppartForm" action="{{-- route('agence.appart.store',[config('app.locale')]) --}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          @include('alerte.message')
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Appartement')}}</h5>
                <small class="text-muted float-end">{{ __('Nouveau')}}</small>
              </div>
              <div class="card-body">
                
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelectCategorie">{{ __('Catégorie')}}</label>
                      <select class="form-select select_categorie " id="categorie" name="categorie">
                        <option selected value=" ">{{ __('Choisir')}}...</option>
                        @foreach($appart->categorie() as $key => $cat)
                        <option value="{{$key}}">{{__($cat)}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('categorie')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                  </div>
                  <div class="mb-3 type_maison">
                    <div class="input-group mb-3">
                      <label class="input-group-text " for="inputGroupSelectTypeAppart">{{__('Type d\'appartement/maison')}} <span class="text-danger">*</span></label>
                      <select class="form-select @error('libelle') is-invalid @enderror type_appartement" id="inputGroupSelectTypeAppart" name="libelle">
                      <option selected value=" ">{{ __('Choisir')}}...</option>
                        <option value="Studio">Studio</option>
                        <option value="2 pièces">2 pièces</option>
                        <option value="3 pièces">3 pièces</option>
                        <option value="4 pièces">4 pièces</option>
                        <option value="5 pièces">5 pièces</option>
                        <option value="Plus de 6 pièces">Plus de 6 pièces</option>
                      </select>
                    </div>
                    @error('libelle')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3 type_maison">
                    <div class="input-group mb-3">
                      <label class="input-group-text " for="inputGroupSelectTypeAppart">{{__('Situé sur/Tye bien')}} <span class="text-danger">*</span></label>
                      <select class="form-select @error('type_immobilier') is-invalid @enderror" id="inputGroupSelectTypebien" name="type_immobilier">
                      <option selected value=" ">{{ __('Choisir')}}...</option>
                        <option value="immeuble">Immeuble</option>
                        <option value="villa basse">Villa basse</option>
                        <option value="duplex">Duplex</option>
                        <option value="triplex">Triplex</option>
                        <option value="entrepot">Entrepôt</option>
                        <option value="autre">Autre</option>
                      </select>
                    </div>
                    @error('type_immobilier')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-3 niveau_appart">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupPhone">{{ __('Niveau')}}<span class="text-danger">*</span></label>
                      <input
                      type="text"
                      id="inputGroupPhone"
                      class="form-control phone-mask "
                      placeholder="1er étage"
                      name="niveau"
                    />
                    </div>
                  </div>
                  <div class="mb-3 type_commerce_appart">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupTypeCommerce">Type de commerce<span class="text-danger">*</span></label>
                      <input
                      type="text"
                      id="inputGroupTypeCommerce"
                      class="form-control phone-mask"
                      placeholder="Boutique"
                      name="commerce"
                    />
                    </div>
                  </div>
                  <div class="mb-3 nb_chambre">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupNbChambre">Nombre de chambre<span class="text-danger">*</span></label>
                      <input
                      type="text"
                      id="inputGroupNbChambre"
                      class="form-control nb_chambre"
                      placeholder="4"
                      name="nb_chambre"
                    />
                    </div>
                  </div>
                  <div class="mb-3 num_appart">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupnumappart">Numéro appartement<span class="text-danger">*</span></label>
                      <input
                      type="text"
                      id="inputGroupnumappart"
                      class="form-control"
                      placeholder="4"
                      name="num_appart"
                    />
                    </div>
                  </div>
                  <div class="mb-3">
                      <small class="text-light fw-semibold d-block">Inline Radio</small>
                      @foreach($appart->meuble() as $key => $meuble)
                      <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="contenu_appart" id="inlineRadio1" value="{{$key}}">
                        <label class="form-check-label" for="inlineRadio1">{{$meuble}}</label>
                      </div>
                      @endforeach
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label" for="inputGroupLocalisation">Localisation</label>
                    <input
                      type="text"
                      id="inputGroupLocalisation"
                      class="form-control @error('localisation') is-invalid @enderror"
                      placeholder="Abidjan, cocody, riviera faya. Carrefour menuisierie. rue 12"
                      name="localisation"
                    />
                  </div>
                   @error('localisation')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                  <div class="mb-3">
                    <label class="form-label" for="inputGroupquartier">Quartier</label>
                    <input
                      type="text"
                      id="inputGroupquartier"
                      class="form-control @error('quartier') is-invalid @enderror"
                      placeholder="faya"
                      name="quartier"
                    />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="inputGroupRue">Rue</label>
                    <input
                      type="text"
                      id="inputGroupRue"
                      class="form-control @error('rue') is-invalid @enderror"
                      placeholder="faya"
                      name="rue"
                    />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="inputGroupDescription">Description</label>
                    <textarea
                      id="inputGroupDescription"
                      class="form-control"
                      placeholder="Salle de séjour etc..."
                      name="description"
                    ></textarea>
                  </div>

                  <div class="mb-3">
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="inputGroupFile">Image de l'appartement</label>
                      <input type="file" class="form-control @error('image_appart') is-invalid @enderror" id="inputGroupFile" name="image_appart" />
                    </div>
                    @error('image_appart')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

              </div>
            </div>

            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Montant du loyer')}}</h5>
                <small class="text-muted float-end">{{ __('Ajouter')}}</small>
              </div>
              <div class="card-body">
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupMontantLoyer">{{ __('Montant')}}</label>
                      <input
                        type="text"
                        id="inputGroupMontantLoyer"
                        class="form-control @error('montant') is-invalid @enderror loyer"
                        placeholder="100000"
                        name="loyer"
                      />
                      <span class="input-group-text">XOF</span>
                    </div>
                    @error('loyer')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Caution')}}</h5>
                <small class="text-muted float-end">{{ __('Ajouter')}}</small>
              </div>
              <div class="card-body">
                
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupCautionLibelle">{{ __('Libelle')}}</label>
                      
                      <input
                      type="text"
                      id="inputGroupCautionLibelle"
                      class="form-control @error('libelle_caution') is-invalid @enderror"
                      value="Caution"
                      name="libelle_caution"
                    />
                    </div>
                    @error('libelle_caution')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelect01">{{ __('Période')}}</label>
                      <select class="form-select @error('periode') is-invalid @enderror" id="inputGroupSelectPeriode" name="periode">
                        <option selected value=" "></option>
                        <option value="1">1 {{__('mois')}}</option>
                        <option value="2">2 {{__('mois')}}</option>
                        <option value="3">3 {{__('mois')}}</option>
                      </select>
                      <!-- <input
                      type="text"
                      id="basic-default-phone"
                      class="form-control phone-mask"
                      placeholder="1 mois"
                      name="periode"
                    /> -->
                    </div>
                    @error('periode')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="montant">{{ __('Montant')}}</label>
                      <input
                        type="text"
                        id="montant"
                        class="form-control @error('montant') is-invalid @enderror"
                        placeholder="100000"
                        name="montant"
                      />
                      <span class="input-group-text">XOF</span>
                    </div>
                    @error('montant')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  

              </div>
            </div>
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Commission agence')}}</h5>
                <small class="text-muted float-end">{{ __('Ajouter')}}</small>
              </div>
              <div class="card-body">
                
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupLibelleCommission">{{ __('Libelle')}}</label>
                      
                      <input
                      type="text"
                      id="inputGroupLibelleCommission"
                      class="form-control @error('libelle_commission') is-invalid @enderror"
                      value="Commission agence"
                      name="libelle_commission"
                    />
                    </div>
                    @error('libelle_commission')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelectPeriodeCommission">{{ __('Période')}}</label>
                      <select class="form-select @error('periode_commission') is-invalid @enderror" id="inputGroupSelectPeriodeCommission" name="periode_commission">
                        <option selected value=" "></option>
                        <option value="1">1 {{__('mois')}}</option>
                        <option value="2">2 {{__('mois')}}</option>
                        <option value="3">3 {{__('mois')}}</option>
                      </select>
                      
                    </div>
                    @error('periode_commission')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="montantCommission">{{ __('Montant')}}</label>
                      <input
                        type="text"
                        id="montantCommission"
                        class="form-control @error('montant_commission') is-invalid @enderror"
                        placeholder="100000"
                        name="montant_commission"
                      />
                      <span class="input-group-text">XOF</span>
                    </div>
                    @error('montant_commission')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  

              </div>
            </div>
          </div>
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Equipements')}}</h5>
                <small class="text-muted float-end">{{__('Choisir les equipements du bien')}}</small>
              </div>
              
              <div class="card-body">
                  <div class="mb-3 row">
                      @foreach($equipements as $equipement)
                      <div class="form-check form-check-inline mt-3 col-3">
                        <input class="form-check-input" type="checkbox" name="equipements[]" id="inlineRadio1" value="{{$equipement->id}}">
                        <label class="form-check-label" for="inlineRadio1">{{$equipement->libelle_equipement}}</label>
                      </div>
                      @endforeach
                  </div>
                  
                
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Accesoires et comodités')}}</h5>
                <small class="text-muted float-end">{{__('Choisir les comodités du bien')}}</small>
              </div>
              
              <div class="card-body">
                  <div class="mb-3 row">
                      @foreach($comodites as $p)
                      <div class="form-check form-check-inline mt-3 col-3">
                        <input class="form-check-input" type="checkbox" name="comodites[]" id="inlineRadio1" value="{{$p->id}}">
                        <label class="form-check-label" for="inlineRadio1">{{$p->libelle_comodite}}</label>
                      </div>
                      @endforeach
                  </div>
                  
                
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Points forts')}}</h5>
                <small class="text-muted float-end">{{__('Points forts du quartier')}}</small>
              </div>
              
              <div class="card-body">
                  <div class="mb-3">
                      @foreach($points_forts as $p)
                      <div class="form-check form-check-inline mt-3 col-3">
                        <input class="form-check-input" type="checkbox" name="points_forts[]" id="inlineRadio1" value="{{$p->id}}">
                        <label class="form-check-label" for="inlineRadio1">{{$p->libelle_point_fort}}</label>
                      </div>
                      @endforeach
                      
                  </div>
                  
                
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Autres caractéristiques')}}</h5>
                <!-- <small class="text-muted float-end">{{__('Points forts du quartier')}}</small> -->
              </div>
              
              <div class="card-body">
                  <div class="mb-3">
                     <label class="form-label" for="inputGroupRue">Surface Habitable</label>
                    <input
                      type="text"
                      id="inputGroupRue"
                      class="form-control @error('surface_habitable') is-invalid @enderror"
                      placeholder="faya"
                      name="surface_habitable"/>
                      
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="inputGroupRue">Nombre de pièces principales</label>
                    <input
                      type="text"
                      id="inputGroupRue"
                      class="form-control @error('nb_piece_principale') is-invalid @enderror"
                      placeholder="faya"
                      name="nb_piece_principale"/>
                      
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="inputGroupRue">Année de construction</label>
                    <input
                      type="text"
                      id="inputGroupRue"
                      class="form-control @error('annee_const') is-invalid @enderror"
                      placeholder="faya"
                      name="annee_const"/>
                      
                  </div>
                  <div class="mb-3">
                      
                      <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="destination_local" id="inlineRadio1" value="Usage d'habitation">
                        <label class="form-check-label" for="inlineRadio1">Usage d'habitation</label>
                      </div>
                      <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="radio" name="destination_local" id="inlineRadio1" value="Usage mixe professionnel et d'habitation">
                        <label class="form-check-label" for="inlineRadio1">Usage mixe professionnel et d'habitation</label>
                      </div>
                      
                  </div>
                  
                
              </div>
            </div>

            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Propriétaire')}}</h5>
                <small class="text-muted float-end">{{__('Détails')}}</small>
              </div>
              
              <div class="card-body">
                  <div class="mb-3">
                    <div class="input-group">
                      <select
                        class="form-select show-tick select_proprio"
                        id="inputGroupSelectProprio"
                        aria-label="Example select with button addon"
                        name ="selectproprietaire"
                      >
                        <option selected value="">{{__('Choisir')}}...</option>
                        

                        @foreach($proprietaires as $proprio)
                          <option value="{{$proprio->id}}">{{$proprio->name}}</option>
                        @endforeach
                      </select>
                      <button class="btn btn-outline-primary new_proprio_btn" name="new_proprio_active_box" value="add proprietaire" type="button">{{ __('Nouveau')}}</button>
                    </div>
                  </div>
                  <div class="box_new_proprio">
                  <div class="mb-3">
                    <label class="form-label" for="nomProprio">Nom</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="nomProprio"
                        placeholder="John Doe"
                        aria-label="Doe"
                        aria-describedby="basic-icon-default-fullname2"
                        name = "proprio_name"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="nomProprio">Prénoms</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text"
                        ><i class="bx bx-user"></i
                      ></span>
                      <input
                        type="text"
                        class="form-control"
                        id="nomProprio"
                        placeholder="John Doe"
                        aria-label="John Doe"
                        aria-describedby="basic-icon-default-fullname2"
                        name = "proprio_lastname"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                      <input
                        type="email"
                        id="proprioEmail"
                        class="form-control"
                        placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com"
                        aria-describedby="basic-icon-default-email2"
                        name="proprio_email"
                      />
                      <!-- <span id="basic-icon-default-email2" class="input-group-text">@example.com</span> -->
                    </div>
                    <div class="form-text">You can use letters, numbers & periods</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-phone">No téléphone</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-phone2" class="input-group-text"
                        ><i class="bx bx-phone"></i
                      ></span>
                      <input
                        type="text"
                        id="proprioPhone"
                        class="form-control phone-mask"
                        placeholder="Ex: 225XXXXXXXXXX"
                        aria-label="Ex: 225XXXXXXXXXX"
                        aria-describedby="basic-icon-default-phone2"
                        name="proprio_phone"
                        
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Pays</label>
                    <div class="input-group input-group-merge">
                      <select
                        class="form-select show-tick"
                        id="inputGroupSelectProprioPays"
                        aria-label="Example select with button addon" name="proprio_pays"
                      >

                        <option selected value=" ">{{__('Choisir')}}...</option>
                        @foreach($countries as $pays)
                          <option value="{{$pays->id}}">{{$pays->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Ville</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text"
                        ><i class="bx bx-buildings"></i
                      ></span>
                      <input
                        type="text"
                        id="proprioVille"
                        class="form-control"
                        placeholder="Abidjan, cocody"
                        aria-label="Abidjan, cocody"
                        aria-describedby="basic-icon-default-company2",
                        name="proprio_ville"
                      />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Adresse</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text"
                        ><i class="bx bx-buildings"></i
                      ></span>
                      <input
                        type="text"
                        id="ProprioAdresse"
                        class="form-control"
                        placeholder="Treichville avenue 13"
                        aria-label="Treichville avenue 13"
                        aria-describedby="basic-icon-default-company2"
                        name="proprio_address"
                      />
                    </div>
                  </div>
                  
                  
                </div>
                
              </div>
            </div>
            
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('Avance')}}</h5>
                <small class="text-muted float-end">{{ __('Ajouter')}}</small>
              </div>
              <div class="card-body">
                
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupAvanceLibelle">{{ __('Libelle')}}</label>
                      
                      <input
                      type="text"
                      id="inputGroupAvanceLibelle"
                      class="form-control @error('libelle_avance') is-invalid @enderror"
                      value="Avance"
                      name="libelle_avance"
                    />
                    </div>
                    @error('libelle_avance')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelectPeriodeAvance">{{ __('Période')}}</label>
                      <select class="form-select @error('periode_avance') is-invalid @enderror" id="inputGroupSelectPeriodeAvance" name="periode_avance">
                        <option selected value=" "></option>
                        <option value="1">1 {{__('mois')}}</option>
                        <option value="2">2 {{__('mois')}}</option>
                        <option value="3">3 {{__('mois')}}</option>
                      </select>
                      <!-- <input
                      type="text"
                      id="basic-default-phone"
                      class="form-control phone-mask"
                      placeholder="1 mois"
                      name="periode"
                    /> -->
                    </div>
                    @error('periode_avance')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <div class="input-group">
                      <label class="input-group-text" for="montantAvance">{{ __('Montant')}}</label>
                      <input
                        type="text"
                        id="montantAvance"
                        class="form-control @error('montant_avance') is-invalid @enderror"
                        placeholder="100000"
                        name="montant_avance"
                      />
                      <span class="input-group-text">XOF</span>
                    </div>
                    @error('montant_avance')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  

              </div>
            </div>
            <button type="submit" class="btn btn-info simple_save" name="save" name="simple_save">Enregistrer</button>
            <a type="button" href="{{route('agence.appartements',[config('app.locale')])}}" class="btn btn-primary save_and_add"  >Liste des biens</a>
          </div>
          
        </div>
      </form>
      @include('alerte.loader') 
    </div>

  @stop