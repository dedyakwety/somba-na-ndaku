@extends('application')

@section('body-article-panier')
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
						<li><a href="">Panier {{ count($commandes) }}</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row">
			@forelse($commandes as $commande)
				<div class="col-lg-7">
					<div class="single_product_pics">
						<div class="row">
							<div class="col-lg-3 thumbnails_col order-lg-1 order-2">
								<div class="single_product_thumbnails">
									<ul>
										<li><img src="{{ asset(Storage::url(articles::find($commande->article->id)->image->path_2)) }}" alt="" data-image="images/single_1.jpg"></li>
										<li class="active"><img src="{{ asset(Storage::url(articles::find($commande->article->id)->image->path_3)) }}" alt="" data-image="images/single_2.jpg"></li>
										<li><img src="{{ asset(Storage::url(articles::find($commande->article->id)->image->path_4)) }}" alt="" data-image="images/single_3.jpg"></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-9 image_col order-lg-2 order-1">
								<div class="single_product_image">
									<div class="single_product_image_background">
										<img src="{{ asset(Storage::url(articles::find($commande->article->id)->image->path_1)) }}" alt="image-pricipale" class="image-principale">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="product_details">
						<div class="product_details_title">
							<h2>{{ Articles::find($commande->article->id)->modele->modele }}</h2>
							<p>{{ $commande->article->commentaire }}</p>
						</div>
						<div class="div-infos">
							<div class="infos">
								<div class="infos-1">
									Taille
								</div>
								<div class="infos-2">
									<p>{{ $commande->taille }}</p>
								</div>
							</div>
						</div>
						<div class="div-infos">
							<div class="infos">
								<div class="infos-1">
									Prix Unitaire
								</div>
								<div class="infos-2">
									<p>
										@if($commande->article->prix < 20)
											${{ number_format(((double)$commande->article->prix + 6), 2, '.', ' ') }}
										@elseif($commande->article->prix >= 20)
											${{ number_format((((double)$commande->article->prix / 100) * (double)$gestion->gain_2) + (double)$commande->article->prix, 2, '.', ' ') }}
										@endif
									</p>
								</div>
							</div>
						</div>
						<div class="div-infos">
							<div class="infos">
								<div class="infos-1">
									Quantité
								</div>
								<div class="infos-2">
									<p>{{ $commande->quantite }}</p>
								</div>
							</div>
						</div>
						<div class="div-infos">
							<div class="infos">
								<div class="infos-1">
									Prix Total
								</div>
								<div class="infos-2">
									<p>
										@if($commande->article->prix < 20)
											${{ number_format((double)$commande->prix_total, 2, '.', ' ') }}
										@elseif($commande->article->prix >= 20)
											${{ number_format((double)$commande->prix_total, 2, '.', ' ') }}
										@endif
									</p>
								</div>
							</div>
						</div>
						<div class="div-infos">
							<div class="infos">
								<div class="infos-1">
									<a href="{{ route('Panier.edit', $commande->id) }}">
										<button type="submit" class="btn btn-outline-success">Modifier</button>
									</a>
								</div>
								<div class="infos-2">
									<form action="{{ route('Panier.destroy', $commande->id) }}" method="POST">
										@csrf
										@method('DELETE')
											<button type="submit" class="btn btn-outline-danger">Suprimer de la commande</button>
									</form>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			@empty
			@if(Session::has('succes'))
			<p>{{ Session::get('succes') }}</p>
			@else
			<h2>Le parnier est vide</h2>
			@endif
			@endforelse
			@if(count($commandes))
				<div class="div-infos_commande">
					<form action="{{ route('Livraison.store') }}" method="POST">
						@csrf
						<h2>Informations pour la livraison</h2>
						<div class="infos">
							<div class="infos-1">
								Date et heure
							</div>
							<div class="infos-2">
								<input type="date" name="date_livraison" id="date_livraison" class="date_heure">
								<select name="heure_livraison" id="heure_livraison" class="date_heure" required>
									<option>HEURE</option>
									<option value="08H00 à 08H30">08H00 à 08H30</option>
									<option value="08H30 à 09H00">08H30 à 09H00</option>
									<option value="09H00 à 09H30">09H00 à 09H30</option>
									<option value="09H30 à 10H00">09H30 à 10H00</option>
									<option value="10H00 à 10H30">10H00 à 10H30</option>
									<option value="10H30 à 11H00">10H30 à 11H00</option>
									<option value="11H00 à 11H30">11H00 à 11H30</option>
									<option value="11H30 à 12H00">11H30 à 12H00</option>
									<option value="12H00 à 12H30">12H00 à 12H30</option>
									<option value="12H30 à 13H00">12H30 à 13H00</option>
									<option value="13H00 à 13H30">13H00 à 13H30</option>
									<option value="13H30 à 14H00">13H30 à 14H00</option>
									<option value="14H00 à 14H30">14H00 à 14H30</option>
									<option value="14H30 à 15H00">14H30 à 15H00</option>
									<option value="15H00 à 15H30">15H00 à 15H30</option>
									<option value="15H30 à 16H00">15H30 à 16H00</option>
									<option value="16H00 à 16H30">16H00 à 16H30</option>
								</select>
							</div>
						</div>
						<div class="comment">
							<div class="infos-comment-1">
								Adresse la livraison
							</div>
							<div class="infos-comment-2">
								<textarea name="adresse_livraison" id="adresse_ligraison" cols="30" rows="10" class="commentaire"></textarea>
							</div>
						</div>
						<div class="infos-1">
								<button type="submit" class="btn btn-outline-success">Valider la Commande</button>
						</div>
					</form>
				</div>
			@endif
		</div>

	</div>

</div>

@endsection