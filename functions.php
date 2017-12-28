<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
} 

/* ----------------------------------------------------------------------------------- */
// Add Divi Builder to TEC Post Types
/* ----------------------------------------------------------------------------------- */
 
function add_tec_post_types( $post_types ) {
    $post_types[] = 'tribe_events';
    $post_types[] = 'tribe_venue';
    $post_types[] = 'tribe_organizer';
      
    return $post_types;
}
add_filter( 'et_builder_post_types', 'add_tec_post_types' );



/* ----------------------------------------------------------------------------------- */
// Generate Auto-Admin-Label
/* ----------------------------------------------------------------------------------- */
 


function dattm_register_admin_js() { ?>

<script>
jQuery(function($){
	
	// text module
	$(document).on('mousedown', '.et-pb-modal-save, .et-pb-modal-save-template', function() {
		
		if ($('.et_pb_module_settings[data-module_type=et_pb_text]').length) { // if text module
			
			// Get the tinymce iframe
			var iframe = document.getElementById('et_pb_content_new_ifr');

			if (iframe) { // Using tinymce
				
				// Get the tinymce dom element
				var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
				var content = $(innerDoc).find('#tinymce');
				
			} else { // Not using tinymce
				
				// Get the textbox content as HTML
				var textbox = $('#et_pb_content_new');
				var content = $($.parseHTML('<div>'+textbox.val()+'</div>'));
				
			}
		
			// Get the first header or paragraph to use as title
			var title = content.children(":header,p").first().text();
			title = (title.length > 80)?(title.substring(0,80)+'...'):title;
			
			// Update the admin label with the title
			$('#admin_label').val(title);
		}
	});
});
</script>

<?php
}
add_action('admin_head', 'dattm_register_admin_js');






?>
