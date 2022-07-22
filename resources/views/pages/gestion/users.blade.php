@extends('application')

@section('body-users')
	<div class="users">
		<h1>Agents</h1>
		<form method="POST" action="{{ route('valider_agent') }}">
			@csrf
			@if(Session::has('erreur'))
				<p>{{ Session::get('erreur') }}</p>
			@elseif(Session::has('succes'))
				<p>{{ Session::get('succes') }}</p>
			@endif
			<input type="email" name="email" placeholder="Adresse email" required>
			<select name="role">
				<option disabled>Role</option>
				@foreach($roles as $role)
					@if($role->role == $user->role->role)
					@else
						<option value="{{ $role->id }}">{{ $role->role }}</option>
					@endif
				@endforeach
			</select>
			<input type="password" name="password" placeholder="Mot de passe" required>
			<button type="submit">Valider</button>
		</form>
	</div>
	<?php
		use Illuminate\Support\Facades\Session;
		Session::forget('erreur');
		Session::forget('succes');
	?>
@endsection