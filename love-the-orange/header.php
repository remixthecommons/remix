<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="author" content="Web Design Creatives" />
	<title><?php if (function_exists('seo_title_tag')) { seo_title_tag(); } else { bloginfo('name'); wp_title();} ?></title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-mosaique.css" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
	<?php wp_head(); ?>
<style type="text/css" media="screen">
	html { margin-top: 0px !important; }
	* html body { margin-top: 0px !important; }
</style>

</head>
<body <?php body_class($class); ?>>
	<div id = "langue">
		<?php echo '<a href="'.qtrans_convertURL('','fr').'">'; ?>Français</a> | <?php echo '<a href="'.qtrans_convertURL('','en').'">'; ?>English</a>
		</div>
<div id="wraper">
	<div class="tc"><span>&nbsp;</span></div>
		
			<!-- Header Start -->
			<div id="header">
				<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
				<span class="title"><?php bloginfo('description'); ?></span>								 				
			</div>

			<div id="mainNav">
				<ul>
				<?php wp_list_pages('title_li='); ?>
				</ul>								
			</div>
			<!-- Header End-->