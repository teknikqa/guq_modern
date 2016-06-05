
<div class="guq-page-wrapper">
  <div class="mobile-overlay"></div>
    <?php if ($current_domain_id == 1): // Main site header ?>
    <header role="banner" id="page-header" class="header sticky clearfix">
      <div class="header-wrapper">
        <!-- print logo -->
        <img src="<?php print $print_logo; ?>" class="visible-print logo" alt="<?php print $site_name; ?>" />
        <?php if ($page['top_nav']): ?>
          <div class="top-nav">
            <div class="container">
                <div id="mobile-button">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </div>
              <?php $top_menu = render($page['top_nav']); print $top_menu; ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="brand-wrapper clearfix">
          <div class="brand container">
            <div id="top-header" class="pull-right">
              <?php print render($page['top_header']); ?>
            </div>
            <div id="logo" class="pull-left">
              <a href="<?php print $front_page; ?>" title="<?php print t('Go to Homepage'); ?>">
                <img class="hidden-print" src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
              </a>
            </div>
          </div>
        </div>
   <?php
     // End main site header.
   else:
     // Domain header
    ?>
    <header role="banner" id="page-header" class="header anti-sticky domain-cirs clearfix">
      <div class="header-wrapper">
         <!-- print logo -->
        <img src="<?php print $print_logo; ?>" class="visible-print logo" alt="<?php print $site_name; ?>" />
      <?php if ($page['top_nav']): ?>
        <div class="top-nav">
          <div class="container">
            <?php print render($page['top_nav']); ?>
              <div id="logo" class="pull-left">
                <a href="<?php print $front_page; ?>" title="<?php print t('Go to Homepage'); ?>">
                <?php /*global $language; if($language->language=="ar"): ?>
                  <a href="<?php print $default_doamin . 'ar/'; ?>" title="<?php print t('Go to Homepage'); ?>">
                <?php else: ?>
                  <a href="<?php print $default_doamin; ?>" title="<?php print t('Go to Homepage'); ?>">
                <?php endif;*/ ?>
                <img class="hidden-print" src="<?php print $guq_cirs_logo; ?>" alt="<?php print $site_name; ?>" />
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="brand-wrapper clearfix">
        <?php /*
        <div class="brand container">
          <div id="domain-logo" class="logo-domain">
            <a href="<?php print $front_page; ?>" title="<?php print t('Go to Homepage'); ?>">
              <img class="" src="<?php print $guq_cirs_logo; ?>" alt="<?php print $site_name; ?>" />
            </a>
          </div>
        </div>
        */ ?>
      </div>
    <?php endif; // end domain header ?>

    <?php if ($main_menu): ?>
      <nav id="nav" class="navbar navbar-default" role="navigation">
        <div class="container">
          <!-- mobile navigation -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-menu-collapse">
              <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <!-- /main navigation -->
          <div class="collapse navbar-collapse navbar-primary-menu-collapse">
            <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('class' => array('links', 'primary-menu', 'nav', 'nav-pills')))); ?>
          </div>
        </div>
      </nav>
    <?php endif; ?>
    <?php if ($page['navigation']): ?>
      <nav id="navigation">
        <div class="container">
          <?php print render($page['navigation']); ?>
        </div>
      </nav>
    <?php endif; ?>
  </div>
  </header>

  <?php if ($page['header_mobile']): ?>
      <div class="hidden-sm visible-xs mobile-menu">
        <div class="container">
          <?php print render($page['header_mobile']); ?>
        </div>
      </div>
  <?php endif; ?>

  <?php if ($title): ?>
  <div id="page-title-wrapper">
    <div class="container">
    <?php if (isset($page_title)): ?>
      <div class="page-header pull-left">
        <?php print render($title_prefix); ?>
          <h1 class="pull-left"><?php print $page_title; ?></h1>
        <?php print render($title_suffix); ?>
        <?php if(isset($page_title_suffix)) : ?>
          <h4 class="page-title-suffix pull-left hidden-xs"><?php print $page_title_suffix; ?></h4>
        <?php endif; ?>
      </div>
    <?php elseif (isset($title)): ?>
      <div class="page-header pull-left">
        <?php print render($title_prefix); ?>
          <h1 class="pull-left"><?php print $title; ?></h1>
        <?php print render($title_suffix); ?>
      </div>
    <?php endif; ?>

        <?php if ($breadcrumb): ?>
          <div id="breadcrumb-wrapper" class="pull-right hidden-xs">
            <?php print $breadcrumb; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if (!empty($tabs['#primary'])): ?>
    <div class="tabs-wrapper">
      <?php print render($tabs); ?>
    </div>
  <?php endif; ?>

  <div id="page">
    <?php if ($page['highlighted']): ?>
      <div>
        <?php print render($page['highlighted']); ?>
      </div>
    <?php endif; ?>

    <?php if ($messages): ?>
      <div id="alerts-wrapper" class="vertical-margin container clearfix">
        <?php print $messages; ?>
      </div>
    <?php endif; ?>

    <!--main content area-->
    <div id="main-content" class="container clearfix">
      <?php if ($page['help']): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>

      <?php if ($action_links): ?>
        <div class="panel panel-default">
          <div class="panel-body">
            <ul class="list-unstyled action-links"><?php print render($action_links); ?></ul>
          </div>
        </div>
      <?php endif; ?>

      <div class="row">
        <!-- first things first -->
        <section class="<?php print $content_column_class; ?> primary-column">
          <?php if(isset($content_title) && !$is_page): ?>
            <h1 class="main-content-title"><?php print $content_title; ?></h1>
          <?php endif; ?>

          <?php if ($page['top_content']): ?>
            <div class="top-content">
              <?php print render($page['top_content']); ?>
            </div>
          <?php endif; ?>

          <div class="main-content-wrapper">
            <?php print render($page['content']); ?>
          </div>
        </section>

        <?php if ($page['sidebar_first']): ?>
          <section class="<?php print $first_sidebar_column_class; ?> col-md-3 col-sm-3 col-xs-12 sidebar tertiary-column basic-page-sidebar" role="complementary" id="tertiary-nav">
            <?php print render($page['sidebar_first']); ?>
          </section>
        <?php endif; ?>

        <?php if ($page['sidebar_second']): ?>
          <section class="<?php print $second_sidebar_column_class; ?>    col-md-3 col-sm-3 col-xs-12 secondary-column sidebar clearfix col-sm-pull-9 col-md-pull-0" role="complementary" id="secondary-nav">
            <?php print render($page['sidebar_second']); ?>
          </section>
        <?php endif; ?>
      </div>
    </div>
    <!-- end main content area -->
    <!--bottom content area-->
    <div id="bottom-content" class="container clearfix">
      <?php if ($page['bottom_content']): ?>
        <?php print render($page['bottom_content']); ?>
      <?php endif; ?>
    </div>
    <!-- end bottom content area -->
  </div>

  <footer id="footer" class="clearfix vertical-margin">

    <?php if ($page['top_footer']): ?>
      <div class="top-footer">
        <div class="container">
          <div class="row">
            <div class="footer-link text-center">
              <span class="switch-link section-switch-link badge"><i class="fa fa-undo"></i>&nbsp;&nbsp;<?php print t('Switch to section footer');?>&nbsp;&nbsp;&nbsp;</span>
              <span class="switch-link main-switch-link badge"><i class="fa fa-undo"></i>&nbsp;&nbsp;<?php print t('Switch to main footer');?>&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="col-sm-12">
              <?php print render($page['top_footer']); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($page['footer_area']): ?>
      <div class="footer-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <?php print render($page['footer_area']); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($page['footer_menu']): ?>
      <div class="footer-menu">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <?php print render($page['footer_menu']); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </footer>
</div>
<div class="mobile-menu-outer-wrapper">
  <div class="mobile-menu-wrapper">
  <?php print get_mobile_menu(); ?>
  </div>
</div>
