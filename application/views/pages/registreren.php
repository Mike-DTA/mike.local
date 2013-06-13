<p>Registreer nu een account!</p><br />

<div class="formcontainer">
	<form method="post" action="">
		<div>
			<label for="first_name">Voornaam</label>
			<input type="text" name="first_name" id="first_name" value="<?= Arr::get($aValues, 'first_name'); ?>" />
			<label for="first_name" class="error"><?= Arr::get($aErrors, 'first_name'); ?></label>
		</div>
		<div>
			<label for="last_name">Achternaam</label>
			<input type="text" name="last_name" id="last_name" value="<?= Arr::get($aValues, 'last_name'); ?>" />
			<label for="last_name" class="error"><?= Arr::get($aErrors, 'last_name'); ?></label>
		</div>
		<div>
			<label for="username">Gebruikersnaam</label>
			<input type="text" name="username" id="username" value="<?= Arr::get($aValues, 'username'); ?>" />
			<label for="username" class="error"><?= Arr::get($aErrors, 'username'); ?></label>
		</div>
		<div>
			<label for="password">Wachtwoord</label>
			<input type="password" name="password" id="password" value="<?= Arr::get($aValues, 'password'); ?>" />
			<label for="password" class="error"><?= Arr::get($aErrors, 'password'); ?></label>
		</div>
		<div>
			<input type="submit" name="registreren" />
		</div>
	</form>
</div>