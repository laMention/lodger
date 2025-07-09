@extends('backend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('Opérations de caisse')}}</span></h4>
      <hr class="my-5" />

      <!-- Responsive Table -->
      

      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table" id="example">
            
            <thead>
              <tr>
                <th>Type operation</th>
                <th>Description</th>
                <th>Date</th>
                <th>Entrée</th>
                <th>Sortie</th>
                @if(auth()->user()->role == 3)
                <th>Enregisté par</th>
                @endif
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="operation_items_form">
              
             @foreach($operations as $op)
              <tr class="operation_items">
                <td>
                  
                  <span class="badge @if($op->type_operation == 1)  bg-success  @endif 
                    @if($op->type_operation == 2) bg-danger @endif">
                    
                    {{$operation->getOperation($op->type_operation)}}
                  </span>

                </td>
                <td>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#editModal-{{$op->id}}">
                  @if(strlen($op->description) >= 21)
                    {!! substr(($op->description), 0, 20) !!}...
                  @else
                    {!! substr(($op->description), 0, 20) !!}
                  @endif
                  </a>
                </td>
                <td>
                  {{date_format(new \DateTime($op->date_operation),'d-m-Y')}}
                </td>
                <td>
                  @if($op->type_operation == 1)
                    <span class="badge bg-label-info">
                      {{number_format($op->montant,'0','.',' ')}}
                    </span>
                  @endif
                </td>
                <td>
                  @if($op->type_operation == 2) 
                    <span class="badge bg-label-primary"> 
                    {{number_format($op->montant,'0','.',' ')}}
                    </span>

                  @endif
                </td>
                @if(auth()->user()->role == 3)
                <td>{{ucfirst(auth()->user()->name)}}</td>
                @endif
                <td>
                  <a href="#" class="text-primary " data-bs-toggle="modal" data-bs-target="#editModal-{{$op->id}}"><i class="fa fa-eye"></i></a>
                  <a href="#" class="text-success "><i class="fa fa-edit"></i></a>
                  <a href="#" class="text-danger "><i class="fa fa-trash"></i></a>
                </td>

                  <div class="modal fade" id="editModal-{{$op->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel3">
                                Modifier l'opération {{$operation->getOperation($op->type_operation)}}
                                de caisse
                              </h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <form id="operationUpdateForm-{{$op->id}}" >
                              <div class="modal-body">
                                
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="type_operation" class="form-label">Operation</label>
                                    <select class="form-select" id="type_operation" name="type_operation" disabled>
                                      <option selected value="">Choisir...</option>
                                      @foreach($operation->type_operation() as $key => $operat)
                                        <option @if ($op->type_operation == 1 ) selected @endif value="1">Entrée en caisse</option>
                                        <option @if ($op->type_operation == 2 ) selected @endif value="2">Sortie de caisse</option>
                                      @endforeach
                                    </select>
                                    <span class="error_type_operation"></span>
                                  </div>
                                  <div class="col mb-0">
                                    <label for="date_operation" class="form-label">Date Opération</label>
                                    <input
                                      type="date"
                                      class="form-control"
                                      id="date_operation"
                                      name="date_operation"
                                      aria-describedby="basic-icon-default-fullname2" 
                                      value="{{date_format(new \DateTime($op->date_operation),'Y-m-d')}}"
                                    />
                                    <span class="error_date_operation"></span>

                                  </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label class="form-label" for="montant_operation">Montant</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="montant_operation"
                                      name="montant_operation"
                                      disabled
                                      value="{{$op->montant}}"
                                    />
                                    <span class="error_montant"></span>

                                  </div>
                                  <div class="col mb-0">
                                    <label class="form-label" for="remarque">Remarque</label>
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="remarque"
                                      name="remarque"
                                      value="{{$op->remarque}}"
                                    />
                                  </div>
                                  
                                </div>
                                <div class="row">
                                  <div class="col mb-0">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control show-wysiwyg" id="description" name="description">
                                      {!! $op->description !!}
                                    </textarea>
                                    <span class="error_description"></span>

                                  </div>
                                </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Fermer
                                </button>
                                <button type="button" class="btn btn-info btnUpdateOperation">Modifier</button>
                                

                              </div>
                            </form>
                          </div>
                        </div>
                  </div>



              </tr>

              

             @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>

    <!-- form -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Opération de caisse</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <form id="operationForm">
                <div class="modal-body">
                  
                  <div class="row g-2">
                    <div class="col mb-0">
                      <label for="type_operation" class="form-label">Operation</label>
                      <select class="form-select" id="type_operation" name="type_operation">
                        <option selected value="">Choisir...</option>
                        <option value="1">Entrée en caisse</option>
                        <option value="2">Sortie de caisse</option>
                      </select>
                      <span class="error_type_operation"></span>
                    </div>
                    <div class="col mb-0">
                      <label for="date_operation" class="form-label">Date Opération</label>
                      <input
                        type="date"
                        class="form-control"
                        id="date_operation"
                        name="date_operation"
                        aria-describedby="basic-icon-default-fullname2" 
                      />
                      <span class="error_date_operation"></span>

                    </div>
                  </div>
                  <div class="row g-2">
                    <div class="col mb-0">
                      <label class="form-label" for="montant_operation">Montant</label>
                      <input
                        type="text"
                        class="form-control"
                        id="montant_operation"
                        name="montant_operation"
                      />
                      <span class="error_montant"></span>

                    </div>
                    <div class="col mb-0">
                      <label class="form-label" for="remarque">Remarque</label>
                      <input
                        type="text"
                        class="form-control"
                        id="remarque"
                        name="remarque"
                      />
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col mb-0">
                      <label class="form-label" for="description">Description</label>
                      <textarea class="form-control show-wysiwyg" id="description" name="description"></textarea>
                      <span class="error_description"></span>

                    </div>
                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Fermer
                  </button>
                  <button type="button" class="btn btn-info btnCreateAndClose">Enregistrer et fermer</button>
                  <button type="button" class="btn btn-danger btnCreateAndNew">Enregistrer et nouveau</button>

                </div>
              </form>
            </div>
          </div>
    </div>
    <div class="buy-now">
      <a href="javascript:void(0);" class="btn btn-danger btn-buy-now" data-bs-toggle="modal" data-bs-target="#basicModal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ajouter une opération</font></font></a>
    </div>
    

  @stop