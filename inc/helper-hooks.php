<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('nexsol_Hooks') ){
	class nexsol_Hooks {

		public function __construct() {
			// Comment Form Default Field
			add_filter( 'comment_form_default_fields', array( $this, 'nexsol_comment_form_default_fields') );
			add_filter( 'comment_form_defaults', array( $this, 'nexsol_comment_form_defaults' ) );
		}

		function nexsol_comment_form_defaults( $defaults ){
			$defaults['comment_field'] = sprintf(
				'<p class="comment-form-comment"> %s</p>',
				'<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="'.esc_attr__( 'Comment here...', 'nexsol' ).'"></textarea>'
			);
			return $defaults;
		}

		function nexsol_comment_form_default_fields( $fields ){
			$commenter     = wp_get_current_commenter();
			$req      = get_option( 'require_name_email' );
			$html_req = ( $req ? " required='required'" : '' );
			$html5 = true;
			$fields['author'] = sprintf( '<p class="comment-form-author">%s</p>',
				sprintf(
					'<input id="author" name="author" type="text" value="%s" placeholder="'.esc_attr__( 'Name', 'nexsol' ).'" size="30" maxlength="245"%s />',
					esc_attr( $commenter['comment_author'] ),
					$html_req
				) );
			$fields['email'] = sprintf(
				'<p class="comment-form-email"> %s</p>',
				sprintf(
					'<input id="email" name="email" %s value="%s" size="30" maxlength="100" placeholder="'.esc_attr__( 'Email', 'nexsol' ).'" aria-describedby="email-notes"%s />',
					( $html5 ? 'type="email"' : 'type="text"' ),
					esc_attr( $commenter['comment_author_email'] ),
					$html_req
				)
			);
			$fields['url'] = sprintf(
				'<p class="comment-form-url">%s</p>',
				sprintf(
					'<input id="url" name="url" %s value="%s" size="30" maxlength="200" placeholder="'.esc_attr__( 'Website', 'nexsol' ).'" />',
					( $html5 ? 'type="url"' : 'type="text"' ),
					esc_attr( $commenter['comment_author_url'] )
				)
			);
			return $fields;
		}
	}
}
new nexsol_Hooks();