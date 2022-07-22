@extends('application')

@section('body-article-edit')
<?php
use App\Models\Articles;
?>
<div class="super_container">

	<div class="container single_product_container">
		<div class="row">
			<div class="col">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.html">Catégorie</a></li>
						<li><a href="categories.html"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ Articles::findOrFail($article->article->id)->categorie->categorie }}</a></li>
						<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ Articles::findOrFail($article->article->id)->modele->modele  }}</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-7">
				<div class="single_product_pics">
					<div class="row">
						<div class="col-lg-3 thumbnails_col order-lg-1 order-2">
							<div class="single_product_thumbnails">
								<ul>
									<li><img src="{{ asset(Storage::url(Articles::findOrFail($article->article->id)->image->path_2)) }}" alt="" data-image="images/single_1.jpg"></li>
									<li class="active"><img src="{{ asset(Storage::url(Articles::findOrFail($article->article->id)->image->path_3)) }}" alt="" data-image="images/single_2.jpg"></li>
									<li><img src="{{ asset(Storage::url(Articles::findOrFail($article->article->id)->image->path_4)) }}" alt="" data-image="images/single_3.jpg"></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 image_col order-lg-2 order-1">
							<div class="single_product_image">
								<div class="single_product_image_background">
									<img src="{{ asset(Storage::url(Articles::findOrFail($article->article->id)->image->path_1)) }}" alt="image-pricipale" class="image-principale">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="product_details">
					<div class="product_details_title">
						<h2>{{ Articles::findOrFail($article->article->id)->modele->modele }}</h2>
						<p>{{ Articles::findOrFail($article->article->id)->commentaire }}</p>
					</div>
					<div class="original_price">
						@if($article->prix < 20)
							<span>{{ number_format(((double)$article->article->prix + 6) + (((double)$article->article->prix / 100) * (double)12.5), 2, '.', ' ') }}</span>
						@elseif($article->article->prix >= 20)
							<span>${{ number_format(((((double)$article->article->prix / 100) * (double)$gestion->gain_2) + (double)$article->article->prix) + (((double)$article->article->prix / 100) * 12.5), 2, '.', ' ') }}</span>
						@endif
					</div>
					<div class="product_price">
						@if($article->prix < 20)
							${{ number_format(((double)$article->article->prix + 6), 2, '.', ' ') }}
						@elseif($article->article->prix >= 20)
							${{ number_format((((double)$article->article->prix / 100) * (double)$gestion->gain_2) + (double)$article->article->prix, 2, '.', ' ') }}
						@endif
					</div>
					<form action="{{ route('Panier.update', $article->id) }}" method="POST" class="div-infos">
						@csrf
						@method('PUT')
						@if((Articles::findOrFail($article->article->id)->categorie->id == 1) OR (Articles::findOrFail($article->article->id)->categorie->id == 2))
						<div class="infos">
							<div class="infos-1">
								Taille
							</div>
							<div class="infos-2">
								<select name="taille" id="heure_livraison" class="date_heure" required>
									@if(Articles::findOrFail($article->article->id)->categorie->id == 1)
										<option value="{{ $article->taille }}">{{ $article->taille }}</option>
										@foreach($tailles_1 as $taille)
											@if($article->taille == $taille)
											@else
											<option value="{{ $taille }}">{{ $taille }}</option>
											@endif
										@endforeach
									@elseif(Articles::findOrFail($article->article->id)->categorie->id == 2)
										@foreach($tailles_2 as $taille)
											<option value="{{ $taille }}">{{ $taille }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
						@endif
						<div class="infos">
							<div class="infos-1">
								Quantité
							</div>
							<div class="infos-2">
								<input type="number" name="quantite" id="contact" class="input" min="1" value="{{ $article->quantite }}" required>
							</div>
						</div>
						<div class="infos">
							<div class="infos-2">
								<button type="submit" name="btn_edit" class="btn btn-outline-success">Mettre à jour</button>
							</div>
						</div>
					</form>
					<div class="div-buttun">
						<div class="red_button add_to_cart_button"><a href="#">Ajouter panier</a></div>
						<div class="red_button add_to_cart_button"><a href="#">Commander</a></div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>

@endsection