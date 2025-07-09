@extends('frontend.partials._template')
  @section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Suggestions / </span>Envoyer</h4>
      <hr class="my-5" />

      <div class="row">
        <div class="col-xxl">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="mb-0">Renseigner avant de soumettre votre formulaire</h5>
              <small class="text-muted float-end">Suggestions</small>
            </div>
            <div class="card-body">
              <form>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-name">Sujet</label>
                  <div class="col-sm-10">
                    <input
                      type="text"
                      class="form-control"
                      id="basic-default-company"
                      
                    />
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-message">Message</label>
                  <div class="col-sm-10">
                    <textarea
                      id="basic-default-message"
                      class="form-control"
                       placeholder="Decrivez l'incident ici..."
                      aria-describedby="basic-icon-default-message2"
                    ></textarea>
                  </div>
                </div>
                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  @stop