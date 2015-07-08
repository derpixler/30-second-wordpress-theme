<?php
/**
 * Pingbacks template
 *
 * @package    WordPress
 * @subpackage 30 Second WordPress Theme\Parts
 */

$num = t30_get_count_pings();
if ( ! $num )
	return;
?>
<h2 id="pingbacks"><?php
	printf( _nx( 'One pingback', '%d pingbacks', $num, 'Pingbacks title', 't30' ), $num ); ?>
</h2>
<ol class="pinglist">
	<?php
	// Custom callback applied adding pings as URLs with favicon.
	wp_list_comments( array (
		'type'	   => 'pings',
		'style'	   => 'ul',
		'callback' => 't30_the_pings'
	) );
	?>
</ol>