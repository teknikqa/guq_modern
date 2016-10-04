<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>
  <head profile="<?php print $grddl_profile; ?>">
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-552cff9377870122"></script>
    <script type="text/javascript">addthis.toolbox('.addthis_toolbox');</script>
      <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <meta http-equiv="cleartype" content="on">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- typekit -->
    <script type="text/javascript" src="//use.typekit.net/zat8mnd.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <!-- Fonts -->
    <script type="text/javascript" src="//fast.fonts.net/jsapi/36b3fb32-8417-420e-90b7-8ec95a4e9de6.js"></script>
    <?php
    /*
    <!-- Icons ================ -->
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png" />
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png" />
    <!-- For iPhone with high-resolution Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png" />
    <!-- For third-generation iPad with high-resolution Retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png" />
    */
    global $base_url;
    ?>
    <?php print $styles; ?>
    <?php print $scripts; ?>
    <!--[if lt IE 9]>
      <script src="<?php print $base_url; ?>/profiles/varuni/themes/guq_modern/js/html5-respond.js"></script>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body class="<?php print $classes; ?> index" <?php print $attributes;?>>
    <div id="skip-links">
      <a class="navlink sr-only sr-only-focusable" href="#navigation" title="<?php print t('Skip to navigation'); ?>" accesskey="n"><?php print t('Skip to navigation'); ?></a>
      <a class="conlink sr-only sr-only-focusable" href="#page" title="<?php print t('Skip to main content'); ?>" accesskey="c"><?php print t('Skip to main content'); ?></a>
    </div>

    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
  </body>
</html>
