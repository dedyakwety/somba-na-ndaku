@extends('application')

@section('body-completion')
<div class="div-completion">

	<h1>Completer votre compte pour continuer</h1>
	@if(Session::has('erreur'))
		<p>{{ Session::get('erreur') }}</p>
	@endif

	<form action="{{ route('Completion_compte.store') }}" method="POST" class="form-completion" enctype="multipart/form-data">
		@csrf
			<input type="file" name="photo_profil" accept=".png, .jpg, .jpeg"><br>
		@if(Auth::user()->role_id == 1)
			<input type="double" name="gain_1" placeholder="Gain < 20$" step="0.01"><br>
			<input type="double" name="gain_2" placeholder="Gain >= 20$" step="0.01"><br>
			<input type="double" name="remise" placeholder="Remise" step="0.01"><br>
			<input type="double" name="transport" placeholder="Transport" step="0.01"><br>
			<input type="double" name="depense" placeholder="Dépense" step="0.01"><br>
			<input type="double" name="agent" placeholder="Paie agent" step="0.01"><br>
			<input type="double" name="admin" placeholder="Paie admin" step="0.01"><br>
			<input type="double" name="entreprise" placeholder="Entreprise" step="0.01"><br>
		@else
			<input type="text" name="postnom" placeholder="Postnom"><br>
			<input type="number" name="numero" placeholder="Numéro Résidence"><br>
			<input type="text" name="avenue" placeholder="Avenue Résidence"><br>
			<input type="text" name="quartier" placeholder="Quartier Résidence"><br>
			<select name="commune"><br>
				@foreach($communes as $commune)
					<option value="{{ $commune }}">{{ $commune }}</option>
				@endforeach
			</select><br>
		@endif
		<button type="submit">Completer</button>
	</form>
</div>
@endsection