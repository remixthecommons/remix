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


## Ajout d'une fonction pour Videopian (extraction d'images de Youtube et cie.
## Par Stéphane Couture -- steph@stephcouture.info
## Voir : http://www.upian.com/upiansource/videopian/en/

include_once "Videopian.php";

function remix_get_thumbnail($id) {

	if ($thumb_url = wp_get_attachment_url(get_post_thumbnail_id($id))) {
		return $thumb_url;
	}
	else if ($url = get_post_meta($id,"wpcf-url-location", true)) {
	     try {
		      $video = Videopian::get($url);
	     }
	     catch (Exception $e) {
         // Décommenter cette ligne si vous souhaitez avoir un message d'erreur si la vidéo ne fonctionne pas.
	       //echo '<i><font color="#ff0000">Error for post #'.$id.', url : '.$url.' :: ',  $e->getMessage(), '</font></i>';
	       return get_template_directory_uri()."/img/thumb_generique.png";
	     }
	     if ($video->site == "vimeo")
		$thumb_url = $video->thumbnails[2]->url;
	     else 
		$thumb_url = $video->thumbnails[0]->url;

             return $thumb_url;
	}
  
  // pas de thumbnail, on retourn une image generique
  return get_template_directory_uri()."/img/thumb_generique.png";
}

function remix_get_player_url($id) {

	if ($url = get_post_meta($id,"wpcf-url-location", true)) {
	     try {
		      $video = Videopian::get($url);
	     }
	     catch (Exception $e) {
               // Décommenter cette ligne si vous souhaitez avoir un message d'erreur si la vidéo ne fonctionne pas.
	       //echo '<i><font color="#ff0000">Error for post #'.$id.', url : '.$url.' :: ',  $e->getMessage(), '</font></i>';
	       return;
	     }
	     return $video->player_url;
	}
}

//
// liaison fiches <--> projets (post)
// via le plugin dedie
// doc. https://github.com/scribu/wp-posts-to-posts/wiki/Basic-usage
function connection_projet_fiche_types() {
	p2p_register_connection_type( array(
		'name' => 'posts_to_pages',
		'from' => 'projet',
		'to' => 'fiche',
	        'admin_box' => array('show' => 'from')
	) );
}
add_action( 'p2p_init', 'connection_projet_fiche_types' );

/// Ajout d'une notification pour la page "add" et "edit" d'un fiche
/// steph@stephcouture.info - 14 mai 2013
add_action('admin_notices', 'my_custom_notice');
function my_custom_notice()
{
    global $current_screen;

    if (('fiche' == $current_screen->post_type) && ($current_screen->id == 'fiche'))
        {

                echo '<div class="updated"><p><b>Formulaire d\'ajout et d\'édition d\'une fiche</b></p><p>N\'hésitez pas à consulter la  <a href="http://wiki.remixthecommons.org/index.php/Questions_fr%C3%A9quentes_-_Entr%C3%A9e_et_modification_d%27une_fiche" target="_blank">page wiki sur les questions fréquentes</a> en cas de de difficulté.</p></div>';
        }
}

/// Ajout d'un message dans la metaxbox de la vignette
/// steph@stephcouture.info - 14 mai 2013
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
    global $current_screen;
    if ('fiche' == $current_screen->post_type)
       return $content .= "<p>Téléversez une image pour ajouter une vignette pour cette fiche. Si vous ne fournissez pas de vignette, la fiche tentera d'extraire une image à partir de l'adresse spécifiée dans le champ \"URL du document\". Si vous n'aimez pas l'image extraite automatiquement, vous pouvez téléverser ici une vignette de remplacement. <b>Une image de format 400x225 est recommandée</b>.</p>";
       else return $content;
}


/// Affichage optimise une sortie pour le plugin types (http://wp-types.com/fr/documentation-2/functions/
/// erational@erational.org - 16 mai 2013
function get_types_field($field)   {
  if (@types_render_field($field, array("show_name"=>false))!="") {
        return types_render_field($field, array("show_name"=>true))."<br>\n"; 
  }
  return;
}


?>
