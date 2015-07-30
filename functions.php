<?php
/* Load the Theme class. */
function theme_enqueue_child_style(){
	wp_enqueue_style('theme-child-style', get_stylesheet_directory_uri(). '/style.css',array('theme-style','theme-skin'),false,'all');
}
add_action('wp_print_styles', 'theme_enqueue_child_style');


//Side Panel
function sidepanel_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'side' => 'left',
    'icon' => 'tools',
	), $atts );
  if ( esc_attr($a['side']) == 'right') { $class = ' right'; }

	return '<div class="side-panel' . $class . '">' . do_shortcode($content) . '<span class="panel-icon"><span class="entypo-' . esc_attr($a['icon']) . '"></span></span></div>';
}
add_shortcode( 'sidepanel', 'sidepanel_shortcode' );


// Tools
function tool_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'title' => '',
    'link' => '',
	), $atts );
  
  $tool = '<section class="third">';
  if (esc_attr($a['title'])) {
    $tool .= '<h4>';
    if (esc_attr($a['link'])) {
      $tool .= '<a href="' . esc_attr($a['link']) . '" rel="external">';
    }
    $tool .= esc_attr($a['title']);
    if (esc_attr($a['link'])) {
      $tool .= '</a>';
    }
    $tool .= '</h4>';
  }
  
  $tool .= '<p>' . $content . '</p>';
  if (esc_attr($a['link'])) {
    $tool .= '<a class="more" href="' . esc_attr($a['link']) . '" rel="external"><span class="entypo-popup"></span>Read More</a>';
  }
  $tool .= '</section>';
  
	return $tool;
}
add_shortcode( 'tool', 'tool_shortcode' );


// Image of the month
function imgmonth_shortcode( $atts ) {
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
      <a href="'.$image.'"><span class="entypo-picture"></span>See full image</a>
    </section>

   ';
}
add_shortcode( 'imgmonth', 'imgmonth_shortcode' );


// Include JS.
function my_scripts_method() {
	wp_enqueue_script(
		'sedas',
		get_stylesheet_directory_uri() . '/js/sedas.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
