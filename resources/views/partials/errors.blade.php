@if ($errors->{ $bag ?? 'default' }->any())
    <div class="alert alert-warning col-xs-12" role="alert" style="margin: 2px 0 0 0;">
        Please check the form below for errors
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span class="fa fa-times"></span> </button>
        <ul> @foreach ($errors->{ $bag ?? 'default' }->all() as $item) <li> {{ $item }} </li> @endforeach </ul>
    </div>
@endif
