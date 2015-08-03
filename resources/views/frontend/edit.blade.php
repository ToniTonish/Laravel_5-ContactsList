@extends('frontend.master.master')

@section('title') Edit Contact Page @endsection 

@section('modal_title') Edit Contact @endsection

@section('content')

{!! Form::model($option) !!}


<div class="media">
	<div class="media-left">
		<div class="media-left">
			{!! Form::file('image', array('class' => 'img-thumbnail', 'id' => 'inputId', 'style' => 'position: absolute; height: 140px; width: 140px; opacity: 0; z-index:9999; cursor: pointer;'))!!}
			<img id="imgId" style="height: 140px; width: 140px; border: 1px solid black" src="{{ URL($option[0]->im_profilo) }}">
		<div id="upImg" style="display: none; background-color: #434343; padding: 10px 0 0 20px; color: #FFFFFF; top: 126px;  width: 140px; height: 50px; position: absolute;">Upload Image</div>
	</div>
	</div>
	<div class="media-body">
		<div id="userSlug" style="display: none;">{{ $option[0]->slug }}</div>
		<div class="form-group">
			{!! Form::label('name', 'First Name', array('class' => 'control-label')) !!}
			{!! Form::text('name', $option[0]->nome, array('class' => 'form-control', 'placeholder' => 'First Name')) !!}
			{!! Form::label('lastname', 'Last Name', array('class' => 'control-label', 'style' => 'margin-top: 15px;')) !!}
			{!! Form::text('lastname', $option[0]->cognome, array('class' => 'form-control', 'placeholder' => 'Last Name')) !!}	
		</div>	
	</div>
</div>

<div class="form-group">
	{!! Form::label('address', 'Address', array('class' => 'control-label')) !!}
	<span class="add-on"><i class="glyphicon glyphicon-home"></i></span>
	{!! Form::text('address', $option[0]->indirizzo, array('class' => 'form-control', 'placeholder' => 'Address')) !!}
</div>
<hr>

<div>
	{!! Form::label('phone', 'Phone Number', array('class' => 'control-label')) !!}
	<span class="add-on"><i class="glyphicon glyphicon-phone"></i></span>
	<button id="addPhoneButton" class="btn btn-success btn-xs pull-right" type="button" onclick="addPhoneForm()">Add Phone</a>
</div>

<div id="phoneList">
	@foreach($option[1] as $opt)
	<div class="form-group removePhone-select-container">
		<div>
			{!! Form::text('phone[]', $opt->phone, array('class' => 'form-control span4', 'placeholder' => 'Phone Number', 'style' => 'width: 85%; display: inline;') ) !!}
			<img class="removePhone" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0px; cursor: pointer;" src="{{ URL('/uploads/minus.png') }}">
		</div>
	</div>
	@endforeach
</div>

<hr>
<div>
	{!! Form::label('email', 'E-mail', array('class' => 'control-label')) !!}
	<span class="add-on"><i class="glyphicon glyphicon-envelope"></i></span>
	<button id="addMailButton" class="btn btn-success btn-xs pull-right" type="button" onclick="addMailForm()">Add Mail</button>
</div>

<div id="mailList">
	@foreach($option[2] as $opt)
	<div class="form-group removeMail-select-container">
		<div>
			{!! Form::email('email[]', $opt->email, array('class' => 'form-control span4', 'placeholder' => 'E-mail', 'style' => 'width: 85%; display: inline;')) !!}
			<img class="removeMail" style="float: right; height: 23px; width: 23px; cursor: pointer; margin: 5px 2px 0 0;" src="{{ URL('/uploads/minus.png') }}">
		</div>
	</div>
	@endforeach
</div>


@endsection

@section('button') 
	{!! Form::button('Save changes >>', array('class' => 'btn btn-primary btn-xs', 'type' => 'submit')) !!}	
@endsection

{!! form::close() !!}

@section('back_button')
	<a href="{{ url('home') }}" class="btn btn-primary pull-left"><< Back</a>
@endsection

<script src="{{ url('js/jquery.js') }}"></script>
<script>

var phoneTemplate = '<div class="form-group removePhone-select-container">'+
		'<div>'+
			'{!! Form::text('phone[]', null, array('class' => 'form-control span4', 'placeholder' => 'Phone Number', 'style' => 'width: 85%; display: inline;') ) !!}'+
			'<img class="removePhone" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0px; cursor: pointer;" src="{{ URL('/uploads/minus.png') }}">'+
			'<img class="addPhone" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0; cursor: pointer;" src="{{ URL('/uploads/plus.png') }}">'+
		'</div>'+
	'</div>';

var mailTemplate = 	'<div class="form-group removeMail-select-container">'+
		'<div>'+
			'{!! Form::email('email[]', null, array('class' => 'form-control span4', 'placeholder' => 'E-mail', 'style' => 'width: 85%; display: inline;')) !!}'+
			'<img class="removeMail" style="float: right; height: 23px; width: 23px; cursor: pointer; margin: 5px 2px 0 0;" src="{{ URL('/uploads/minus.png') }}">'+
			'<img class="addMail" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0; cursor: pointer;" src="{{ URL('/uploads/plus.png') }}">'+
		'</div>'+
	'</div>'; 

	/*$('#addPhoneButton').click(function() {
		alert('lol');
		$("#phoneList").append(template);
	});*/

	function addPhoneForm() {
		$("#phoneList").append(phoneTemplate);
	}

	function addMailForm() {
		$("#mailList").append(mailTemplate);
	}

	$(document).ready(function() {

		// this function remove phone number from DB
		$(document).on("click", 'img.removePhone', function () {
			if ( $(this).siblings('input').val() === "" ) {
        		$(this).parents('.removePhone-select-container').remove();
			} else {
				var userSlug = $('#userSlug').text();
				var userPhone = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();
				//$(this).parents('.removePhone-select-container').remove();  
				$.ajax({
					type: "POST",
					url: userSlug + "/delete-phone",
					data: {userSlug: userSlug,
						   userPhone: userPhone,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							window.location.replace(userSlug);
						}
					}
				});
			}
		});

		// this function remove mail from DB
		$(document).on("click", 'img.removeMail', function () {
			if ( $(this).siblings('input').val() === "" ) {
        		$(this).parents('.removeMail-select-container').remove();
			} else {
				var userSlug = $('#userSlug').text();
				var userMail = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();
				//$(this).parents('.removePhone-select-container').remove();  
				$.ajax({
					type: "POST",
					url: userSlug + "/delete-mail",
					data: {userSlug: userSlug,
						   userMail: userMail,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							window.location.replace(userSlug);
						}
					}
				});
			}

    	});

    	// Add phone number to a user
    	$(document).on("click", 'img.addPhone', function () {
			if ( $(this).siblings('input').val() === "" ) {
        		;
			} else {
				var userSlug = $('#userSlug').text();
				var userPhone = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();
				//$(this).parents('.removePhone-select-container').remove();  
				$.ajax({
					type: "POST",
					url: userSlug + "/add-phone",
					data: {userSlug: userSlug,
						   userPhone: userPhone,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							window.location.replace(userSlug);
						}
					}
				});
			}
		});

		    	// Add mail to a user
    	$(document).on("click", 'img.addMail', function () {
			if ( $(this).siblings('input').val() === "" ) {
        		;
			} else {
				var userSlug = $('#userSlug').text();
				var userMail = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();
				//$(this).parents('.removePhone-select-container').remove();  
				$.ajax({
					type: "POST",
					url: userSlug + "/add-mail",
					data: {userSlug: userSlug,
						   userMail: userMail,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							window.location.replace(userSlug);
						}
					}
				});
			}
		});


    	/*$(document).on("click", 'img.removeMail',function () {
    		if ( $(this).siblings('input').val() === "" ) {
        		$(this).parents('.removeMail-select-container').remove();
    		} else {
    			var userSlug = $('#userSlug').text();
    			var userMail = $(this).siblings('input').val();
    		}

    	});*/

	});

</script>


