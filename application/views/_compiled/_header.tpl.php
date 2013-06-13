<?php $_ = OutlineRuntime::start(__FILE__, isset($this) ? $this : null); ?><div class="container">
	<div class="header">
		<div class="menu">
			<div class="item">
				<a href="/voorpagina">Index</a>
			</div>
		
			<div class="item last">
			<?php if ($logged_in) { ?>
				Ingelogd als: <a href="/beveiligd/gebruiker"><?php echo $userdata['first_name']; ?></a>
				<a href="/voorpagina/uitloggen" class="small">Uitloggen</a>
			<?php } else { ?>
				<a href="/voorpagina/inloggen">Inloggen</a> of
				<a href="/voorpagina/registreren">Registreren</a>
			<?php } ?>
			</div>
		</div>
	</div>

	<div class="content"><?php $_ = OutlineRuntime::finish(__FILE__); ?>