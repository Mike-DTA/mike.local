<div class="container">
	<div class="header">
		<div class="menu">
			<div class="item">
				<a href="/voorpagina">Index</a>
			</div>
		
			<div class="item last">
			{if $logged_in}
				Ingelogd als: <a href="/beveiligd/gebruiker">{$userdata['first_name']}</a>
				<a href="/voorpagina/uitloggen" class="small">Uitloggen</a>
			{else}
				<a href="/voorpagina/inloggen">Inloggen</a> of
				<a href="/voorpagina/registreren">Registreren</a>
			{/if}
			</div>
		</div>
	</div>

	<div class="content">