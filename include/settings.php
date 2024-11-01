<?php
if (isset($_GET) && isset($_GET['msg'])):
	$msg = sanitize_text_field($_GET['msg']) ? : FALSE;
if ($msg):
	if ($msg == 'saved') $msg = 'Settings have been saved.';
	if ($msg == 'access') $msg = 'Access generated!';
	if ($msg == 'reset') $msg = 'Settings reset!';
?>
<div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible">
<p><strong><?php echo $msg; ?></strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
<?php endif;endif; ?>
<h1>YD Support Settings</h1>
<ul class="yd-tab">
  <a href="<?php echo esc_url(home_url().'/wp-admin/admin.php?page=YD-Support')?>" style="cursor:default;"><li id="active">General</li></a>
  <a href="<?php echo esc_url(home_url().'/wp-admin/admin.php?page=YD-Addon');?>" style="cursor:default;"><li>Add-ons</li></a>
  <a target="_blank" href="https://app.yeshourun.com/service-requests/submit" style="cursor:default;"><li>Service Request</li></a>
  <a target="_blank" href="https://help.yeshourun.com" style="cursor:default;"><li>Help</li></a>
</ul>

<div class="grid-container-top">
  <div class="top-content">
		<form method="post" action="options.php">
    <input type="hidden" name="page" value="<?php echo esc_attr('YD-Support'); ?>">
    <?php settings_fields( 'Yeshourun_PLUGIN' ); ?>
<table class="form-table" role="presentation">
<tbody><tr>
<tr>
  <h2>Grant Yeshourun Digital Support Access</h2>
	<p>
		Before granting access, you must be registered for a
		<a target="_blank" href="https://yeshourun.com/website-maintenance-support-plans/">maintenance</a> or
		<a target="_blank" href="https://yeshourun.com/web-design-development-plans/">design</a> plan.
		Get help choosing a plan <a target="_blank" href="https://yeshourun.com/contact/">here</a>.
		<a target="_blank" href="https://app.yeshourun.com/services/personal-foichrehdt552ewpkw8g/checkout">Register for the free plan</a>.
	</p>
<tr>

<th scope="row"><label for="Yeshourun_Allow">Allow Access</label><span class="dashicons-before dashicons-editor-help tooltip"><p><span class="tooltiptext" style="font-weight:300;">Creates a user that Yeshourun Digital
support engineers will have access to. To revoke access, simply delete the user "ydigital" or click Reset.</span></p></span></th>
<td>
<?php if(!get_option('Yeshourun_Create')) : ?>
<button class="yd-button yd-button-primary" type="submit" name="Yeshourun_Yeshourun_Access" value="1">Allow Access</button>
<?php else : ?>
<button onclick="event.preventDefault();" class="yd-button yd-button-access tooltip">Access Granted<span class="tooltiptext" style="font-weight:300;">To revoke access, press Reset.</span></button>
<?php endif; ?>
<p class="description">By clicking Allow Access, you are creating a new administrator <a href="<?php echo home_url(); ?>/wp-admin/users.php">user</a>.</p>
</td>
</tr>
</tr>
</tr></tbody></table>
	</div>
</div>
<div class="grid-container">
  <div class="left-content">
		<form method="post" action="options.php">
		<input type="hidden" name="page" value="<?php echo esc_attr('YD-Support'); ?>">
		<?php settings_fields( 'Yeshourun_PLUGIN' ); ?>
		<table class="form-table" role="presentation">
		<tbody><tr>
		<tr>
			<h2>Branding</h2>
		<tr>
		<th scope="row"><label for="Yeshourun_Brand">Show Branding</label><span class="dashicons-before dashicons-editor-help tooltip"><p><span class="tooltiptext" style="font-weight:300;">Do you want to show "Maintained by Yeshourun Digital" branding at the footer of your website?</span></p></span></th>
		<td>
		<input style="display:none;" name="Yeshourun_Brand" id="Yeshourun_Brand" type="checkbox" <?php if(get_option('Yeshourun_Brand') == 'on') echo 'checked'; ?>>

		<div id="bcontainer">
			<div class="inner-container">
				<div class="toggle">
					<p>NO</p>
				</div>
				<div class="toggle">
					<p>YES</p>
				</div>
			</div>
			<div class="inner-container" id='toggle-container' <?php if(get_option('Yeshourun_Brand') == 'on') echo 'style="clip-path: inset(0px 50% 0px 0px); background-color: #4F6DF5;"'; else echo 'style="clip-path: inset(0px 0px 0px 50%); background-color: rgb(215, 64, 70);"'; ?>>
				<div class="toggle">
					<p>NO</p>
				</div>
				<div class="toggle">
					<p>YES</p>
				</div>
			</div>
		</div>

		<p class="description"><a href="https://help.yeshourun.com/en/articles/4793526-i-subscribed-to-the-personal-plan-now-what">Read more about branding</a>.</p>
		</td>
		</tr>
		</tr>
		</tr></tbody></table>
		<p class="submit">
		<input type="submit" name="submit_yd" id="submit" class="yd-button yd-button-primary" value="<?php echo esc_attr('Save Changes'); ?>"><br class="hide-desk"><br class="hide-desk">
		<input type="submit" name="reset_yd" id="reset_yd" class="yd-button yd-button-secondary" value="Reset" style="margin-left: 10px;" onclick='document.getElementById("Yeshourun_Brand").checked = false;'></p>
		<p>
			<span style="color:red;"><strong>Important!</strong></span> Only click Reset if you know what you're doing. By clicking Reset, you are revoking access to YD support engineers and removing footer branding, if enabled.
		</p>
		</form>
	</div>
  <div class="right-content">
		<h2>Important Links</h2>
			<div class="yd-imp-links">
				<h2><a target="_blank" href="https://app.yeshourun.com">Login</a></h2>
				<h2><a target="_blank" href="https://app.yeshourun.com/services">View plans</a></h2>
				<h2><a target="_blank" href="https://app.yeshourun.com/services/personal-foichrehdt552ewpkw8g/checkout" class="tooltip">Sign up for free maintenance<p><span class="tooltiptext" style="font-weight:300;">If you haven't already and aren't subscribed to Business or above.</span></p></a></h2>
			</div>
	</div>
</div>

<script>
var toggle = document.getElementById('bcontainer');
var toggleContainer = document.getElementById('toggle-container');
var toggleNumber;
toggle.addEventListener('click', function() {
  toggleNumber = document.getElementById('Yeshourun_Brand').checked;
  if (toggleNumber) {
    toggleContainer.style.clipPath = 'inset(0 0 0 50%)';
    toggleContainer.style.backgroundColor = '#D74046';
	document.getElementById("Yeshourun_Brand").checked = false;
  } else {
    toggleContainer.style.clipPath = 'inset(0 50% 0 0)';
    toggleContainer.style.backgroundColor = '#4F6DF5';
	document.getElementById("Yeshourun_Brand").checked = true;
  }
});
</script>
