<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /><!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17729085694"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'AW-17729085694');
  </script> <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="l-header">
    <div class="l-header__inner">
      <div class="l-header__container">
        <h1 class="l-header__logo"><a href="/">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo-theta.svg" type="image/svg+xml" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo-theta.svg" alt="Theta" width="158" height="57" />
            </picture>
          </a></h1>
        <div class="l-header__right">
          <div class="l-header__cta"> <a class="l-header__cta-link u-uppercase wf-oswald" href="https://thestage.co.jp/item.html/31" target="_blank" rel="noopener noreferrer">Online Store</a></div>
          <div class="c-ham__container"><button class="c-ham"><span class="c-ham__inner"><span class="c-ham__line"></span><span class="c-ham__line"></span><span class="c-ham__line"></span></span></button></div>
          <nav class="l-header-nav">
            <div class="l-header-nav__overlay"></div>
            <div class="l-header-nav__inner">
              <ul class="l-header-nav__list">
                <li class="l-header-nav__item"><a class="l-header-nav__link" href="<?php echo esc_url(home_url('')); ?>" target="" rel="">home</a></li>
                <li class="l-header-nav__item"><a class="l-header-nav__link" href="<?php echo esc_url(home_url('products')); ?>" target="" rel="">Products</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>