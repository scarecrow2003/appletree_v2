<?php
/**
 * Apple Tree template for generating pagination
 *
 * @package WordPress
 * @subpackage Apple Tree
 * @since Apple Tree 1.0
 */
?>

<?php

	global $wp_query;

	$total = $wp_query->max_num_pages;

	if ( $total > 1 ) {

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		echo paginate_links(
			array(
				'base' => $pagenum_link,
				'format' => $format,
				'current' => $paged,
				'total' => $total,
				'add_args' => array_map( 'urlencode', $query_args ),
				'mid_size' => 4,
				'type' => 'list',
				'prev_text'    => '&laquo',
				'next_text'    => '&raquo',
			)
		);
	}