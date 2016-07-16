@extends('layouts.app')

@section('content')

	<div class="row">

		<div class="col-md-6 col-md-offset-3">

			<a href="/items">Return to Items</a>

			<div class="jumbotron">

				<h1>{{ $item->name }}</h1>

				<p>{{ $item->description }}</p>

				<div class="container">

					<p>
						<a class="btn btn-primary btn-lg" href="/items/{{ $item->id }}/edit" role="button">Edit</a>
						<a class="btn btn-danger btn-lg" href="/items/{{ $item->id }}/delete" role="button">Delete</a>
					</p>

				</div>

			</div>


			<div class="container">
				<p class="text-muted">Average Price Paid: $4 | Average Shelf Life: 14 days</p>
			</div>

			<div class="container">

				<h3>Store Ranking</h3>

				<ul class="list-unstyled">

					<li class="text-success"><strong>Sprouts: 15 <span class="glyphicon glyphicon-star" aria-hidden="true"></span></strong></li>
					<li>Sams Club: 4</li>
					<li>Walmart: 2</li>
					<li><a href="#">+ Show More</a></li>

				</ul>

			</div>

			<div class="container">

				<h3>+ Status Tags</h3>

				<ul class="list-unstyled">

					<li>Essential</li>
					<li>In Stock</li>

				</ul>

			</div>

			<div class="container">

				<h3>+ Descriptive Tags</h3>

				<ul class="list-unstyled">

					<li>Dairy</li>
					<li>Refrigerated</li>

				</ul>

			</div>

			<div class="container">

				<h3>+ Personal Tags</h3>

				<ul class="list-unstyled">

					<li>Breakfast</li>
					<li>Kids</li>
					<li>Beverage</li>
					<li>Jocelyn Compatible</li>

				</ul>

			</div>

			<div class="container">

				<h3>+ Recipe Tags</h3>

				<ul class="list-unstyled">

					<li>Chili Rellano Bake</li>
					<li>Mac and Cheese Bake</li>

				</ul>

			</div>

		</div>

	</div>

@stop