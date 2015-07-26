@extends('frontend.master.master')

@section('title') User Page @endsection 

@section('modal_title') Contacts List @endsection

@section('content')

@foreach($users as $user)
	<div style="border: 1px solid rgba(0,0,0,.2); border-radius: 6px; height: 100px; box-shadow: 0 5px 15px rgba(0,0,0,.5); padding: 10px; margin: 0 0 10px 0;">
		<img data-src="holder.js/140x140" class="img-thumbnail pull-left" alt="140x140" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGVjNDU5OGEwYiB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZWM0NTk4YTBiIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0Njg3NSIgeT0iNzQuNSI+MTQweDE0MDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 80px; height: 80px;">
		<span class="pull-left" style="margin-left: 10px;">
			<p>{{ $user->nome }} {{ $user->cognome }}</p>
		</span>
		<div class="pull-right" style="margin-top: 20px;">
			<button type="button" class="btn btn-danger">Edit</button>
		</div>
	</div>
@endforeach

@endsection

@section('back_button')
	<a href="{{ url('/') }}" class="btn btn-primary pull-left"><< Home Page</a>
@endsection

@section('button') Add New Contact >> @endsection