<?php
/**
 * AccessPress Pro Custom Metabox
 *
 * @package Accesspress Pro
 */
add_action('add_meta_boxes', 'accesspress_parallax_add_metabox');
function accesspress_parallax_add_metabox()
{

    add_meta_box(
                 'accesspress_parallax_sidebar_layout', // $id
                 'Sidebar Layout', // $title
                 'accesspress_parallax_sidebar_layout_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority


    add_meta_box(
                 'accesspress_parallax_page_header_image', // $id
                 'Header Banner Image', // $title
                 'accesspress_parallax_page_header_image_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority
}


$accesspress_parallax_sidebar_layout = array(
        'left-sidebar' => array(
                        'value'     => 'left-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/options-framework/images/left-sidebar.png'
                    ), 
        'right-sidebar' => array(
                        'value' => 'right-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/options-framework/images/right-sidebar.png'
                    ),
        'both-sidebar' => array(
                        'value'     => 'both-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/options-framework/images/both-sidebar.png'
                    ),
       
        'no-sidebar' => array(
                        'value'     => 'no-sidebar',
                        'thumbnail' => get_template_directory_uri() . '/inc/options-framework/images/no-sidebar.png'
                    )   

    );

function accesspress_parallax_sidebar_layout_callback()
{ 
global $post , $accesspress_parallax_sidebar_layout;
wp_nonce_field( basename( __FILE__ ), 'accesspress_parallax_sidebar_layout_nonce' ); 
?>

<table class="form-table page-meta-box">
<tr>
<td colspan="4"><em class="f13"><?php _e('Choose Sidebar Template','accesspress_parallax')?></em></td>
</tr>

<tr>
<td>
<?php  
   foreach ($accesspress_parallax_sidebar_layout as $field) {  
                $accesspress_parallax_sidebar_metalayout = get_post_meta( $post->ID, 'accesspress_parallax_sidebar_layout', true ); ?>

                <div class="hide-radio radio-image-wrapper">
                <input id="<?php echo $field['value']; ?>" type="radio" name="accesspress_parallax_sidebar_layout" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $accesspress_parallax_sidebar_metalayout ); if(empty($accesspress_parallax_sidebar_metalayout) && $field['value']=='right-sidebar'){ echo "checked='checked'";} ?>/>
                <label class="description" for="<?php echo $field['value']; ?>">
                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" />
                </label>
                </div>
                <?php } // end foreach 
                ?>
                
</td>
</tr>
<tr> 
    <td><em class="f13"><?php echo sprintf(__('You can set up the sidebar content <a href="%s" target="_blank">here','accesspress_parallax'), admin_url('/widgets.php')) ?></a></em></td>
</tr>
</table>

<?php } 

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function accesspress_parallax_save_sidebar_layout( $post_id ) { 
    global $accesspress_parallax_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accesspress_parallax_sidebar_layout_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accesspress_parallax_sidebar_layout_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  
    

    foreach ($accesspress_parallax_sidebar_layout as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'accesspress_parallax_sidebar_layout', true); 
        $new = sanitize_text_field($_POST['accesspress_parallax_sidebar_layout']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'accesspress_parallax_sidebar_layout', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'accesspress_parallax_sidebar_layout', $old);  
        } 
     } // end foreach   
     
}
add_action('save_post', 'accesspress_parallax_save_sidebar_layout'); 


function accesspress_parallax_page_header_image_callback(){
    global $post ;
    wp_nonce_field( basename( __FILE__ ), 'accesspress_parallax_page_header_image_nonce' ); 
    ?>

    <table class="form-table page-meta-box">
    <tr>
    <td colspan="4"><em class="f13"><?php _e('Upload the Header Image','accesspress_parallax'); ?></em></td>
    </tr>

    <tr>
    <td>
        <?php
            $output = '';
            $id = '';
            $class = '';
            $int = '';
            $value = get_post_meta( $post->ID, 'accesspress_parallax_page_header_image', true );

            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<input id="upload-header-image" class="upload' . $class . '" type="text" name="accesspress_parallax_page_header_image" value="' . $value . '" placeholder="' . __('No file chosen', 'accesspress_parallax') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                if (( $value == '')) {
                    $output .= '<input class="upload-button button" type="button" value="' . __('Upload', 'accesspress_parallax') . '" />' . "\n";
                } else {
                    $output .= '<input class="remove-file button" type="button" value="' . __('Remove', 'accesspress_parallax') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'accesspress_parallax') . '</i></p>';
            }

            $output .= '<div class="screenshot page-banner-thumb">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image">Remove</a>';
                $attachment_id = accesspress_get_attachment_id_from_url($value);
                $image_array = wp_get_attachment_image_src( $attachment_id, 'large');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $image_array[0] . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = __('View File', 'accesspress_parallax');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
        ?>
    </td>
    </tr>
    </table>

<?php 
}

function accesspress_parallax_save_page_header_image( $post_id ) { 
    global $post; 

    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'accesspress_parallax_page_header_image_nonce' ] ) || !wp_verify_nonce( $_POST[ 'accesspress_parallax_page_header_image_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
    
     if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }  

        //Execute this saving function
        $old = get_post_meta( $post_id, 'accesspress_parallax_page_header_image', true); 
        $new = esc_url_raw($_POST['accesspress_parallax_page_header_image']);
        if ( $new && '' == $new ){
            add_post_meta( $post_id, 'accesspress_parallax_page_header_image', $new );
        }elseif ($new && $new != $old) {  
            update_post_meta($post_id, 'accesspress_parallax_page_header_image', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'accesspress_parallax_page_header_image', $old);  
        } 
}
add_action('save_post', 'accesspress_parallax_save_page_header_image'); 