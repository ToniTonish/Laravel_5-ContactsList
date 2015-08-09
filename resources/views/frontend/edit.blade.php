@extends('frontend.master.master')

@section('title') Edit Contact Page @endsection 

@section('modal_title') Edit Contact @endsection

@section('content')

{!! Form::model($option, array('files' => true)) !!}


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
			<div class="hidePhone" style="display: none;">{{ $opt->phone }}</div>
			{!! Form::text('phone[]', $opt->phone, array('class' => 'form-control span4', 'placeholder' => 'Phone Number', 'style' => 'width: 85%; display: inline;') ) !!}	
			<img class="removePhone" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0px; cursor: pointer;" src="{{ URL('/uploads/minus.png') }}">
			<img class="updatePhone" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0; cursor: pointer; display: none" src="{{ URL('/uploads/update.png') }}">
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
			<div class="hideMail" style="display: none;">{{ $opt->email }}</div>
			{!! Form::email('email[]', $opt->email, array('class' => 'form-control span4', 'placeholder' => 'E-mail', 'style' => 'width: 85%; display: inline;')) !!}
			<img class="removeMail" style="float: right; height: 23px; width: 23px; cursor: pointer; margin: 5px 2px 0 0;" src="{{ URL('/uploads/minus.png') }}">
			<img class="updateMail" rel="popover" data-content="Wrong mail" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0; cursor: pointer; display: none" src="{{ URL('/uploads/update.png') }}">
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
			'<img class="addMail" rel="popover" data-content="Wrong mail" style="float: right; height: 23px; width: 23px; margin: 5px 2px 0 0; cursor: pointer;" src="{{ URL('/uploads/plus.png') }}">'+
		'</div>'+
	'</div>'; 

	function addPhoneForm() {
		$("#phoneList").append(phoneTemplate);
	}

	function addMailForm() {
		$("#mailList").append(mailTemplate);
		$(".addMail").popover({
   			placement: 'left',
			html : true,
    		trigger : 'hover', 
   			delay: { 
     			show: "000", 
     			hide: "100"
  			}
   		});
	}

	$(document).ready(function() {

		$(".updateMail").popover({
			placement: 'left',
			html : true,
    		trigger : 'hover', 
   			delay: { 
     			show: "000", 
     			hide: "100"
   			}
   		});

		// this function remove phone number from DB
		$(document).on("click", 'img.removePhone', function () {

			if ( $(this).siblings('input').val() === "" ) {
        		$(this).parents('.removePhone-select-container').remove();
			} else {
				var removePhoneNumber = $(this).parents('.removePhone-select-container');
				var userSlug = $('#userSlug').text();
				var userPhone = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();

				$.ajax({
					type: "POST",
					url: userSlug + "/delete-phone",
					data: {userSlug: userSlug,
						   userPhone: userPhone,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							removePhoneNumber.remove();
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
				var removeUserMail = $(this).parents('.removeMail-select-container');
				var userSlug = $('#userSlug').text();
				var userMail = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();

				$.ajax({
					type: "POST",
					url: userSlug + "/delete-mail",
					data: {userSlug: userSlug,
						   userMail: userMail,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							removeUserMail.remove();
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
				var addPhoneNumber = $(this);
				var userSlug = $('#userSlug').text();
				var userPhone = $(this).siblings('input').val();
				var CSRF_TOKEN = $('input[name="_token"]').val();

				$.ajax({
					type: "POST",
					url: userSlug + "/add-phone",
					data: {userSlug: userSlug,
						   userPhone: userPhone,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							addPhoneNumber.remove();
						}
					}
				});
			}
		});

		// Update phone number to a user
    	$(document).on("click", 'img.updatePhone', function () {
			if ( $(this).siblings('input').val() === "" ) {
        		;
			} else {
				var updatePhoneNumber = $(this);
				var userSlug = $('#userSlug').text();
				var newUserPhone = $(this).siblings('input').val();
				var oldUserPhone = $(this).siblings('.hidePhone').text();
				var CSRF_TOKEN = $('input[name="_token"]').val();
	
				$.ajax({
					type: "POST",
					url: userSlug + "/update-phone",
					data: {userSlug: userSlug,
						   newUserPhone: newUserPhone,
						   oldUserPhone: oldUserPhone,
						   _token: CSRF_TOKEN},
					success: function(response) {
						
						if (response.success) {
							updatePhoneNumber.remove();
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
				var addUserMail = $(this);
				var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i;
				var userMail = $(this).siblings('input').val();

				if (pattern.test(userMail)) {
					$(this).popover('hide');
					var userSlug = $('#userSlug').text();
					var CSRF_TOKEN = $('input[name="_token"]').val();

					$.ajax({
						type: "POST",
						url: userSlug + "/add-mail",
						data: {userSlug: userSlug,
							   userMail: userMail,
							   _token: CSRF_TOKEN},
						success: function(response) {
							
							if (response.success) {
								addUserMail.remove();
							}
						}
					});
				} else {
					$(this).popover({placement: 'left',
						html : true,
    					trigger : 'hover', //<--- you need a trigger other than manual
   						delay: { 
     						show: "000", 
     						hide: "100"
   						}
   					});
				}
			}
		});

		// Update mail to a user
    	$(document).on("click", 'img.updateMail', function () {
			if ( $(this).siblings('input').val() === "" ) {
        		;
			} else {
				var updateUserMail = $(this);
				var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i;
				var newUserMail = $(this).siblings('input').val();

				if (pattern.test(newUserMail)) {
					$(this).popover('hide');
					var userSlug = $('#userSlug').text();
					var oldUserMail = $(this).siblings('.hideMail').text();
					var CSRF_TOKEN = $('input[name="_token"]').val();

					$.ajax({
						type: "POST",
						url: userSlug + "/update-mail",
						data: {userSlug: userSlug,
							   newUserMail: newUserMail,
							   oldUserMail: oldUserMail,
							   _token: CSRF_TOKEN},
						success: function(response) {
						
							if (response.success) {
								updateUserMail.remove();
							}
						}
					});
				} else {
					$(this).popover({placement: 'left',
						html : true,
    					trigger : 'hover', 
   						delay: { 
     						show: "000", 
     						hide: "100"
   						}
   					});

				}
			}
		});

		$(document).on("mouseover", 'img.updateMail', function () {
			var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i;
			var newUserMail = $(this).siblings('input').val();
			if (pattern.test(newUserMail)) {
				$(this).popover('hide');
			}
		});

		$(document).on("mouseover", 'img.addMail', function () {
			var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i;
			var newUserMail = $(this).siblings('input').val();
			if (pattern.test(newUserMail)) {
				$(this).popover('hide');
			}
		});
		

		$(document).on("keyup", 'div.removePhone-select-container > div > input', function () {

			if ( $(this).val() == $(this).siblings('.hidePhone').text()  ) {
				$(this).siblings('img.updatePhone').hide();
			} else if ( $(this).val() === "" ) {
        		;
        	} else {
        		$(this).siblings('.updatePhone').show();
        	}
		});

		$(document).on("keyup", 'div.removeMail-select-container > div > input', function () {

			if ( $(this).val() == $(this).siblings('.hideMail').text()  ) {
				$(this).siblings('img.updateMail').hide();
			} else if ( $(this).val() === "" ) {
        		;
        	} else {
        		$(this).siblings('.updateMail').show();
        	}
		});

	});


</script>


