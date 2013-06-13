<?php $_ = OutlineRuntime::start(__FILE__, isset($this) ? $this : null); ?><p>Registreer nu een account!</p><br />

<div class="formcontainer">
	<?= Form::open( null, array('method'=>'post')) ?>
		<? foreach($aFormFields as $sFieldName => $sLabel): ?>
		<div>
			<label for="<?= $sFieldName ?>"><?= $sLabel ?></label>
			<input type="<?= $sFieldName == 'password'?'password':'text' ?>" name="<?= $sFieldName ?>" id="<?= $sFieldName ?>" value="<?= Arr::get($aValues, $sFieldName); ?>" />
			<label for="<?= $sFieldName ?>" class="error"><?= Arr::get($aErrors, $sFieldName); ?></label>
		</div>
		<? endforeach; ?>
		<div>
			<input type="submit" name="registreren" />
		</div>
	<?= Form::close(); ?>
	</div><?php $_ = OutlineRuntime::finish(__FILE__); ?>