<?php
/**
 * This function helps to render meta data with from dynamic meta data email tag.
 * Note: meta data email tag must be in given format {meta_*}
 *
 * @param $content
 * @param $tag_args
 *
 * @return mixed
 */
function give_render_meta_data_email_tag( $content, $tag_args ){
	if( ! isset( $tag_args['payment_id'] ) ) {
		return $content;
	}

	preg_match_all( "/{meta_([A-z0-9\-\_]+)}/s", $content, $matches );

	if( ! empty( $matches[0] ) ) {
		$search = $replace = array();
		foreach ( $matches[0] as $index => $meta_tag ) {
			if( in_array( $meta_tag, $search ) ) {
				continue;
			}

			$search[] = $meta_tag;
			$meta_name = str_replace( array( '{', 'meta_', '}' ) , '', $meta_tag );
			$replace[] = give_get_meta( absint( $tag_args['payment_id'] ), $meta_name, true, '' );
		}

		if( ! empty( $search ) && ! empty( $replace ) ) {
			$content = str_replace( $search, $replace, $content );
		}
	}


	return $content;
}
add_filter( 'give_email_template_tags', 'give_render_meta_data_email_tag', 10, 2 );