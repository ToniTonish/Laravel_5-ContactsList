@extends('frontend.master.master')

@section('title') Add Contact Page @endsection 

@section('modal_title') Add New Contact @endsection

@section('content')

{!! Form::open(array('files' => true)) !!}


<div class="media">
	<div class="media-left">
		{!! Form::file('image', array('class' => 'img-thumbnail', 'id' => 'inputId', 'style' => 'position: absolute; height: 140px; width: 140px; opacity: 0; z-index:9999; cursor: pointer;'))!!}
		<img id="imgId" style="height: 140px; width: 140px; border: 1px solid black" src="{{ URL('uploads/default.png') }}">
		<div id="upImg" style="display: none; background-color: #434343; padding: 10px 0 0 20px; color: #FFFFFF; top: 126px;  width: 140px; height: 50px; position: absolute;">Upload Image</div>
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
	{!! Form::button('Save contact >>', array('class' => 'btn btn-primary btn-xs', 'type' => 'submit')) !!}	
@endsection

{!! form::close() !!}

@section('back_button')
	<a href="{{ url('home') }}" class="btn btn-primary pull-left"><< Back</a>
@endsection