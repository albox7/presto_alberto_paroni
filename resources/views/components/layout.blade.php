<!DOCTYPE html>
<html lang="it">
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ $title ?? 'Presto' }}</title>
		<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">
		@vite('resources/css/app.css')
	</head>

	<body>

		{{-- Navbar --}}
		<x-navbar />


		{{-- CONTENUTO --}}
		<main class="extra-pad-top">
			{{ $slot }}
		</main>


		{{-- FOOTER --}}
		<x-footer />
		

		@vite('resources/js/app.js')
	</body>
</html>
