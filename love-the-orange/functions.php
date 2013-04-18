<?php
// Prepare for localization
//load_theme_textdomain ('branfordmagazine');
// xili-language plugin check
function init_language(){
	if (class_exists('xili_language')) {
		define('THEME_TEXTDOMAIN','love-the-orange');
		define('THEME_LANGS_FOLDER','/lang');
	} else {
	   load_theme_textdomain('love-the-orange', get_template_directory() . '/lang');
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

?>
