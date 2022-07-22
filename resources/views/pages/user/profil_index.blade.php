@extends('application')

@section('body-profil-index')
<div class="div-profil">

	<h1>Profil</h1>
	@if(Session::has('succes'))
	<p>{{ Session::get('modification') }}</p>
	@endif
	@if(Session::has('erreur'))
		<p>{{ Session::get('erreur') }}</p>
	@endif
	<div class="div-id">
		<p>Nom : {{ $user->name }}</p>
		<p>Postnom : {{ $user->postnom }}</p>
		<p>Prénom : {{ $user->prenom }}</p>
		<p>Sexe : {{ $user->sexe }}</p>
		<p>Etat civil : {{ $user->etat_civil }}</p>
		<p>Contact whatsapp : {{ $user->contact_whatsapp }}</p>
		<p>Contact : {{ $user->contact }}</p>
		<p>E-mail : {{ $user->email }}</p>
		<p>Numéro : {{ $user->adresse->numero }}</p>
		<p>Avenue : {{ $user->adresse->avenue }}</p>
		<p>Quartier : {{ $user->adresse->quartier }}</p>
		<p>Commune : {{ $user->adresse->commune }}</p>
		<p>Mot de passe : {{ "* * * * * * * * " }}<a href="{{ route('Mot_de_passe.index') }}">Changer le mot de passe</a></p>
		<a href="{{ route('Profil.edit', $user->id) }}">Editer tout</a>
	</div>

</div>
@endsection