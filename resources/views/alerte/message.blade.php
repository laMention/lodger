    @if ($message = Session::get('success'))
    <div class="container mt-3 mb-3">
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! $message !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
   	@if ($message = Session::get('info'))
    <div class="container mt-3 mb-3">
        <div class="alert alert-info alert-dismissible" role="alert">
            {!! $message !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if ($message = Session::get('warning'))
    <div class="container mt-3 mb-3">
        <div class="alert alert-warning alert-dismissible" role="alert">
            {!! $message !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </div>
   	@endif
   	@if ($message = Session::get('error'))
    <div class="container mt-3 mb-3">
        <div class="alert alert-danger alert-dismissible" role="alert">
            {!! $message !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
         
	@if ($errors->any())
    <div class="container mt-3 mb-3">
        <div class="alert alert-primary alert-dismissible" role="alert">
            {!! $message !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
	    
    </div>
	@endif       


