<?php $_ = OutlineRuntime::start(__FILE__, isset($this) ? $this : null); ?><p>Log nu in!</p><br />

<?php if ($show_login_failure_notice) { ?>
<div class="message-box error"><p>Gebruiker onbekend of verkeerde combinatie van gebruikersnaam/email en wachtwoord.</p></div>
<?php } ?>

<div class="formcontainer">
	<?= Form::open( null, array('method'=>'post')) ?>
		<? foreach($aFormFields as $sFieldName => $sLabel): ?>
		<div>
			<label for="<?= $sFieldName ?>"><?= $sLabel ?></label>
			<input type="<?= $sFieldName == 'password'?'password':'text' ?>" name="<?= $sFieldName ?>" id="<?= $sFieldName ?>" value="<?= Arr::get($aValues, $sFieldName); ?>" />
		</div>
		<? endforeach; ?>
		<div>
			<input type="submit" name="inloggen" />
		</div>
	<?= Form::close(); ?>
	</div><?php $_ = OutlineRuntime::finish(__FILE__); ?>