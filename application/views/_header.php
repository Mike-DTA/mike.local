<div class="container">
	<div class="header">
		<div class="menu">
			<div class="item">
				<a href="/voorpagina">Index</a>
			</div>
		
			<div class="item last">
			{if isset($logged_in) && $logged_in}
				Ingelogd als: <a href="/beveiligd/gebruiker">$username</a>
				<a href="/beveiligd/uitloggen" class="small">Uitloggen</a>
			{else}
				<a href="/beveiligd/inloggen">Inloggen</a> of
				<a href="/voorpagina/registreren">Registreren</a>
			{/if}
			</div>
		</div>
	</div>

	<div class="content">