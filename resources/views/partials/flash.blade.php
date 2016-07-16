@if (session()->has('flash_message'))

	<h5 class="text-{{ session('flash_message_level') }}">{{ session('flash_message') }}</h5>

@endif