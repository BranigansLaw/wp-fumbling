<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg smart-lead-page">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<?php
$lead_page_type = 2;
$leadPageId = get_the_ID();

$smart_lead_page_conversions = get_post_meta( $leadPageId, 'conversions', true );
$smart_lead_page_conversions = ( isset($smart_lead_page_conversions) && !is_null($smart_lead_page_conversions) && is_array( $smart_lead_page_conversions )) ? $smart_lead_page_conversions : array();

$numConversionsRegistered = count( $smart_lead_page_conversions );
$numConversionsGoal = esc_html( get_post_meta( $leadPageId, 'num_signups_needed', true ) );
if ($numConversionsGoal == 0)
{
	$conversionPercentage = 0;
}
else {
	$conversionPercentage = ( $numConversionsRegistered * 100 ) / $numConversionsGoal;
}

$success_message = esc_html( get_post_meta( $leadPageId, 'success_message', true ) );
$gr_site_key = esc_html( get_post_meta( $leadPageId, 'gr_site_key', true ) );

$background_image_id = esc_html( get_post_meta( $leadPageId, 'background_image_id', true ) );
$logo_image_id = esc_html( get_post_meta( $leadPageId, 'logo_image_id', true ) );
?>

Single Lead Page: <?php $leadPageId; ?>
<br>

<?php 
if ($lead_page_type === 1) {
	include_once( 'basic-info-and-signup-page.php' );
} else if ($lead_page_type === 2) {
	include_once( 'complex-offering-lead-page.php' );
} else {
	echo "Error";
}
?>

<?php if ( !empty( $numConversionsGoal ) ) : ?>
	<div class="progress">
	<?php if ($conversionPercentage >= 100) : ?>
		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
		</div>
	<?php else : ?>
	  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $numConversionsRegistered ?>" aria-valuemin="0" aria-valuemax="<?php echo $numConversionsGoal ?>" 	style="width:<?php echo $conversionPercentage ?>%"><?php echo $numConversionsRegistered ?>/<?php echo $numConversionsGoal ?></div>
	<?php endif; ?>
	</div>
<?php endif; ?>

<img src="<?php echo wp_get_attachment_url( $background_image_id ) ?>" />
<img src="<?php echo wp_get_attachment_url( $logo_image_id ) ?>" />

<form id="submissionForm" data-toggle="validator" role="form">
	<div class="form-group">
		<label for="inputName" class="control-label">Email</label>
		<input type="email" name="email" placeholder="Email" data-error="Please enter a valid email address." required />
	</div>
	<div id='recaptcha' class="g-recaptcha" data-sitekey="<?php echo $gr_site_key ?>" data-callback="submitGoogleRecaptcha" data-size="invisible"></div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" />
	</div>
	<input type="hidden" name="leadPageId" value="<?php echo $leadPageId ?>" />
	<input type="hidden" name="wp_nonce" value="<?php echo wp_create_nonce( 'smart_leads_nonce' ) ?>" />
</form>

<div class="alert alert-success" style="display: none;" id="success-alert">
	<button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Message sent! </strong>
    <?php echo $success_message ?>
</div>

<?php wp_footer(); ?>

</body>
</html>