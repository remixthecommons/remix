<?php


// localization
load_theme_textdomain ('branfordmagazine');     // chaine de langue

function init_language(){
	if (class_exists('xili_language')) {     //xili-language plugin check
		define('THEME_TEXTDOMAIN','sakura');
		define('THEME_LANGS_FOLDER','/lang');
	} else {
	   load_theme_textdomain('sakura', get_template_directory() . '/lang');
	}
}
add_action ('init', 'init_language');


if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Sidebar 1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Sidebar 2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

add_action('hess-type_add_form', 'qtrans_modifyTermFormFor');
add_action('hess-type_edit_form', 'qtrans_modifyTermFormFor');


/// Affichage optimise une sortie pour le plugin types (http://wp-types.com/fr/documentation-2/functions/
/// erational@erational.org - 16 mai 2013
function get_types_field($field)   {
  if (@types_render_field($field, array("show_name"=>false))!="") {
        return types_render_field($field, array("show_name"=>true))."<br>\n"; 
  }
  return;
}


?>
