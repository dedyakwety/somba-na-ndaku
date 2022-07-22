<form action="{{ route('Articles.store') }}" method="POST" class="div-ajout-article" enctype="multipart/form-data">
	@csrf
	@if(Session::has('succes'))
		<p>{{ Session::get('succes') }}</p>
	@endif
	@if(Session::has('erreur'))
		<p>{{ Session::get('erreur') }}</p>
	@endif
	<div class="div-form">
		<h4 class="h4">Ajouter un article</h4>
	</div>
	<div class="div-form">
		<select name="boutique" id="categorie">
			<option>Boutique</option>
			@foreach($boutiques as $boutique)
			<option value="{{ $boutique->id }}" class="option">{{ $boutique->nom }}</option>
			@endforeach
		</select>
	</div>
	<div class="div-form">
		<select name="pour" id="categorie">
			<option>Pour</option>
			@foreach($pours as $pour)
				<option value="{{ $pour->id }}" class="option">{{ $pour->pour }}</option>
			@endforeach
		</select>
	</div>
	<div class="div-form">
		<select name="categorie" id="categorie">
			<option>Catégorie 1</option>
			@foreach($categories as $categorie)
				<option value="{{ $categorie->id }}" class="option">{{ $categorie->categorie }}</option>
			@endforeach
		</select>
	</div>
	<div class="div-form">
		<select name="modele" id="categorie">
			<option>Catégorie 2</option>
			@foreach($modeles as $modele)
				<option value="{{ $modele->id }}" class="option">{{ $modele->modele }}</option>
			@endforeach
		</select>
	</div>
	<div class="div-form">
		<input type="file" name="image_1" id="image" class="file">
	</div>
	<div class="div-form">
		<input type="file" name="image_2" id="image" class="file">
	</div>
	<div class="div-form">
		<input type="file" name="image_3" id="image" class="file">
	</div>
	<div class="div-form">
		<input type="file" name="image_4" id="image" class="file">
	</div>
	<div class="div-form">
		<input type="number" name="prix" id="prix" step="0.01" placeholder="Prix d'article" />
	</div>
	<div class="div-form">
		<textarea name="commentaire">Commentaire</textarea>
	</div>
	<a href="#"><button class="red_button shop_now_button" type="submit">Ajoutez</button></a>
</form>