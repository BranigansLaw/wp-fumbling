<?php
/**
 * The template for displaying search forms in asher
 */
?>
<form role="search" method="get" id="search" style="float:none;" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="col-md-9 search-field" placeholder="<?php echo esc_attr_x( 'Search here &hellip;', 'placeholder', 'tdwowbiscaya' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'tdwowbiscaya' ); ?>">
	<input type="submit" class="col-md-3 search-submit" value="<?php echo esc_attr_x( '', 'submit button', 'tdwowbiscaya' ); ?>">
</form>
