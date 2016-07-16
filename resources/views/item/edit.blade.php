@extends('layouts.app')

@section('content')

	<div class="row">

		<div class="col-md-6 col-md-offset-3">

			<h1>{{ $item->name }}</h1>

			<form method="POST" action="/items/{{ $item->id }}">

				{{ csrf_field() }}

				{{ method_field('PATCH') }}

				<div class="form-group">

					<label name="name">Name:</label>
					<input name="name" class="form-control" value="{{ (!empty(old('name')) ? old('name') : $item->name) }}"/>

				</div>

				<div class="form-group">

					<label name="description">Description:</label>
					<textarea name="description" class="form-control">{{ (!empty(old('description')) ? old('description') : $item->description) }}</textarea>

				</div>

				<div class="form-group">

					<button type="submit" class="btn btn-primary">Update Item</button>

				</div>

			</form>

		</div>

	</div>

@stop