@extends('application')

@section('body-profil-edit')
<div class="div-profil">

	<h1>Edition Profil</h1>

	<form action="{{ route('Profil.store') }}" method="POST" class="div-id">
		@csrf
		<p>{{ "Fonction : ". Auth::user()->role->role }}</p>
		<input type="text" name="nom" value="{{ $user->name }}">
		<input type="text" name="postnom" value="{{ $user->postnom }}">
		<input type="text" name="prenom" value="{{ $user->prenom }}">
		<select name="sexe">
			<option value="{{ $user->sexe }}">{{ $user->sexe }}</option>
			<?php
				$sexes = [
					'homme' => 'homme',
					'femme' => 'femme',
				];
			?>
			@foreach($sexes as $sexe)
				@if(($user->sexe == $sexe) === false)
					<option value="{{ $sexe }}">{{ $sexe }}</option>
				@endif
			@endforeach
		</select>
		<input type="text" name="etat_civil" value="{{ $user->etat_civil }}">
		<input type="text" name="contact_whatsapp" value="{{ $user->contact_whatsapp }}">
		<input type="text" name="contact" value="{{ $user->contact }}">
		<input type="text" name="email" value="{{ $user->email }}">
		<input type="text" name="numero" value="{{ $user->adresse->numero }}">
		<input type="text" name="avenue" value="{{ $user->adresse->avenue }}">
		<input type="text" name="quartier" value="{{ $user->adresse->quartier }}">
		<select name="commune">
			<option value="{{ $user->adresse->commune }}">{{ $user->adresse->commune }}</option>
			@foreach($communes as $commune)
				@if(($user->adresse->commune == $commune) === false)
					<option value="{{ $commune }}">{{ $commune }}</option>
				@endif
			@endforeach
		</select>
		<input type="text" name="password" value="* * * * * * * *" disabled>
		<a href="{{ route('Profil.index') }}">Annuler</a>
		<button type="submit">Modifier</button>
	</form>

</div>
@endsection