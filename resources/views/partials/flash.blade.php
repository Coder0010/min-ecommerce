@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <i class="fa fa-check mx-2"></i>
        <strong>Success</strong> {{ $message }}
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="text-black alert alert-warning alert-dismissible fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <i class="fa fa-info mx-2"></i>
        <strong>Warning</strong> {{ $message }}
    </div>
@endif

@if ($message = Session::get('danger'))
    <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <i class="fa fa-times mx-2"></i>
        <strong>Danager</strong> {{ $message }}
    </div>
@endif
