@extends('frontend.master.master')

@section('title') User Page @endsection 

@section('modal_title') Contacts List @endsection

@section('content')

@foreach($users as $user)
	<div class="userEdit" style="border: 1px solid rgba(0,0,0,.2); border-radius: 6px; height: 100px; box-shadow: 0 5px 15px rgba(0,0,0,.5); padding: 10px; margin: 0 0 10px 0;">
		<div id="userSlug" style="display: none;">{{ $user->slug }}</div>
		<img data-src="holder.js/140x140" class="img-thumbnail pull-left" alt="140x140" src="{{ $user->im_profilo }}" data-holder-rendered="true" style="width: 80px; height: 80px;">
		<span class="pull-left" style="margin-left: 10px;">
			<p>{{ $user->nome }} {{ $user->cognome }}</p>
		</span>
		<div class="pull-right" style="margin-top: 0px;">
			<span class="pull-right" style="margin: 0 0 3px 0;">
				<a href="{{ url('edit/' . $user->slug )}}" class="btn btn-primary btn-xs">Edit</a>
			</span>
			{!! Form::open() !!}
			{!! Form::hidden('id', $user->id) !!}	
			{!! Form::button('Delete', array('class' => 'btn btn-danger btn-xs', 'type' => 'submit')) !!}	
			{!! Form::close() !!}

		</div>
	</div>
@endforeach

@endsection

@section('back_button')
	<a href="{{ url('/') }}" class="btn btn-primary pull-left"><< Home Page</a>
@endsection

@section('button') Add New Contact >> @endsection

<script src="{{ url('js/jquery.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('dblclick', ".userEdit", function(){
			var userSlug = $(this).children("#userSlug").text();
			$.ajax({
					type: "GET",
					url: "edit/" + userSlug,
					data: {},
					success: function() {
						window.location.replace("edit/" + userSlug);
					}
				});
		});

	});

</script>