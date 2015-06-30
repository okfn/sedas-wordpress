<?php
/* Load the Theme class. */
function theme_enqueue_child_style(){
	wp_enqueue_style('theme-child-style', get_stylesheet_directory_uri(). '/style.css',array('theme-style','theme-skin'),false,'all');
}
add_action('wp_print_styles', 'theme_enqueue_child_style');


// Image of the month
function imgmonth_func( $atts ) {
    $a = shortcode_atts( array(
        'width' => '300',
        'height' => '241',
    ), $atts );

    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id,'full');  
    $thumb_url = wp_get_attachment_image_src($image_id,array($a['width'], $a['height']));  
    $image = $image_url[0];
    $thumb = $thumb_url[0];
    $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
    $image_description = get_post(get_post_thumbnail_id())->post_content;

    return '
    <section>
      <h4>Image of the month</h4>
      <a href="'.$image.'"><img src="'.$thumb.'" alt=""></a>
      <p>'.$image_caption.'</p>
      <p>'.$image_description.'</p>
      <a href="'.$image.'">See full image</a>
    </section>
    <span class="panel-icon"><span class="entypo-picture"></span></span>
   ';
}
add_shortcode( 'imgmonth', 'imgmonth_func' );
