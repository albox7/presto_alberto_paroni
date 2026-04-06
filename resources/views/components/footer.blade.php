<footer class="container-fluid">
	<div class="row row-col-2 footer">
		<div class="col-auto">
			<a href="/">
				<img src="{{ asset('media/logo-presto.svg') }}" class="logo-footer" alt="Logo">
			</a>
		</div>
		<div class="col-auto">
			<small>&copy; {{ date('Y') }} Presto.it S.r.l. &nbsp; &middot; &nbsp; Tutti i diritti sono riservati &nbsp; &middot; &nbsp;</small>
			
			<a href="{{ route('become.revisor') }}" class="accent">
				Diventa revisore
			</a>
			
		</div>
	</div>
</footer>