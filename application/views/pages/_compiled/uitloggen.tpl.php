<?php $_ = OutlineRuntime::start(__FILE__, isset($this) ? $this : null); ?><p>Uitloggen</p>

<?php if ($show_not_logged_in_notice) { ?>
<div class="message-box error"><p>Je bent niet ingelogd.</p></div>
<?php } ?>

<?php if ($show_logged_out_notice) { ?>
<div class="message-box success"><p>Je bent uitgelogd.</p></div>
<?php } ?>
<?php $_ = OutlineRuntime::finish(__FILE__); ?>