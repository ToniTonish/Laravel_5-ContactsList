@extends('frontend.master.master')

@section('title') Edit Contact Page @endsection 

@section('modal_title') Edit Contact @endsection

@section('content')

{!! Form::open() !!}


<div class="media">
	<div class="media-left">
		<img data-src="holder.js/140x140" class="img-thumbnail" style="padding: 70px;" alt="140x140" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGVjNDU5OGEwYiB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZWM0NTk4YTBiIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzQuNSI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
	</div>
	<div class="media-body">
		<div class="form-group">
			{!! Form::label('name', 'First Name', array('class' => 'control-label')) !!}
			{!! Form::text('name', null, array('class' => 'form-control ', 'placeholder' => 'First Name')) !!}
			{!! Form::label('lastname', 'Last Name', array('class' => 'control-label', 'style' => 'margin-top: 15px;')) !!}
			{!! Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => 'Last Name')) !!}	
			</div>	
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', 'Address', array('class' => 'control-label')) !!}
	<span class="add-on"><i class="glyphicon glyphicon-home"></i></span>
	{!! Form::text('address', null, array('class' => 'form-control', 'placeholder' => 'Address')) !!}
</div>
<hr>

<div class="form-group">
	{!! Form::label('phone', 'Phone Number', array('class' => 'control-label')) !!}
	<span class="add-on"><i class="glyphicon glyphicon-phone"></i></span>
	{!! Form::text('phone', null, array('class' => 'form-control', 'placeholder' => 'Phone Number')) !!}
</div>

<hr>
<div class="form-group">
	{!! Form::label('email', 'E-mail', array('class' => 'control-label')) !!}
	<span class="add-on"><i class="glyphicon glyphicon-envelope"></i></span>
	{!! Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) !!}
</div>


@endsection

@section('button') 
	{!! Form::button('Save changes >>', array('class' => 'btn btn-primary btn-xs', 'type' => 'submit')) !!}	
@endsection

{!! form::close() !!}

@section('back_button')
	<a href="{{ url('home') }}" class="btn btn-primary pull-left"><< Back</a>
@endsection