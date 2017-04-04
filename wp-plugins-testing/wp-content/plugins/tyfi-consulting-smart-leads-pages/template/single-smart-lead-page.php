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

$numConversionsRegistered = count( get_post_meta( $leadPageId, 'conversions', true ) );
$numConversionsGoal = esc_html( get_post_meta( $leadPageId, 'num_signups_needed', true ) );
$conversionPercentage = ( $numConversionsRegistered * 100 ) / $numConversionsGoal;
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

<div class="progress">
<?php if ($conversionPercentage >= 100) { ?>
	<div class="progress">
		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
	</div>
<?php } else { ?>
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $numConversionsRegistered ?>" aria-valuemin="0" aria-valuemax="<?php echo $numConversionsGoal ?>" style="width:<?php echo $conversionPercentage ?>%"><?php echo $numConversionsRegistered ?>/<?php echo $numConversionsGoal ?></div>
<?php } ?>
</div>

<form id="submissionForm">
	<input type="email" name="email" />
	<input type="hidden" name="leadPageId" value="<?php echo $leadPageId ?>" />
	<input type="submit" />
</form>

<input type="hidden" id="formType" value="unset" />

<?php wp_footer(); ?>

</body>
</html>