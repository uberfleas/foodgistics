@extends('layouts.app')

@section('content')
	
	<div class="row">

		<div class="col-md-6 col-md-offset-3">
	
			<h1>Items</h1>

			@include('partials.flash')

			<div style="overflow-y: scroll; height:400px;">

				<ul class="list-unstyled">

					@foreach($items as $item)

						<li>

							<div class="btn-group" role="group" aria-hidden="true">
								<a href="/items/{{ $item->id }}/edit">	
								<button type="button" class="btn btn-default btn-xs" aria-label="Edit {{ $item->name }}">
	  							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</button></a>
								<a href="/items/{{ $item->id }}/delete">
								<button type="button" class="btn btn-default btn-xs" aria-label="Delete {{ $item->name }}">
	  							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button></a>
							</div>
							<a href="/items/{{ $item->id }}">{{ $item->name }}</a>
							<small class="pull-right">{{ $item->description }}</small>

						</li>

					@endforeach

				</ul>

			</div>

			<form method="POST" action="/items/store">

				<!-- This is to make it so that laravel doesn't throw a csrf token error on submit to prevent Cross Site Request Forgery --> 
				<!-- <input type="hidden" name="_token" value="{{  csrf_token() }}"> -->
				{{ csrf_field() }}

				<div class="form-group">

					<label name="name">Name:</label>
					<input name="name" class="form-control" value="{{ old('name') }}"/>

				</div>

				<div class="form-group">

					<label name="description">Description:</label>
					<textarea name="description" class="form-control">{{ old('description') }}</textarea>

				</div>

				<div class="form-group">

					<button type="submit" class="btn btn-primary">Add Item</button>

				</div>

			</form>

			@if (count($errors))

				<ul>
					@foreach($errors->all() as $error)
						<li><span class="text-danger">{{ $error }}</span></li>
					@endforeach
				</ul>

			@endif

		</div>

	</div>

@stop