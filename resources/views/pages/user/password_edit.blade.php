@extends('application')

@section('body-password-edit')
	<div class="div-profil">
		<form method="POST" action="{{ route('Mot_de_passe.store') }}">
			@csrf
			<input type="password" name="password_ancien" placeholder="Ancient mot de padde">
			<input type="password" name="password" placeholder="nouveau mot de passe">
			<input type="password" name="password_confirm" placeholder="Confirmer nouveau mot de passe">
			<button type="submit">Modifier</button>
		</form>
	</div>
@endsection