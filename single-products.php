<?php

/**
 * Template Name: 商品詳細
 */
?><?php get_header(); ?><div id="smooth-wrapper">
  <div id="smooth-content">
    <div class="l-wrapper">
      <main class="l-main">
        <div class="p-products-single">
          <div class="l-inner">
            <section class="p-products-hero">
              <div class="p-products-hero__main">
                <div class="p-products-hero__left">
                  <div class="p-products-hero__title">
                    <h1 class="p-products-hero__title-text wf-oswald filter-shadow"><?php the_title(); ?></h1>
                  </div>
                  <div class="c-btn-round u-uppercase --left"><a class="box-shadow" href="<?php the_field('store_url'); ?>" target="_blank" rel="noopener noreferrer"><span>ONLINE STORE</span></a></div>
                </div>
                <div class="p-products-hero__right">
                  <div class="c-list__item">
                    <article class="c-list-card">
                      <div class="c-list-card__flex">
                        <div class="c-list-card__inner --hero">
                          <h2 class="c-list-card__title wf-oswald"><?php the_title(); ?></h2>
                        </div>
                        <div class="c-list-card__images --hero"><?php $image1 = get_field('pattern_a');
                                                                $image2 = get_field('pattern_b'); ?><div class="c-list-card__img --img1 --active" data-image="<?php echo $image1['label']; ?>"><?php echo wp_get_attachment_image($image1['image'], 'full'); ?></div>
                          <div class="c-list-card__img --img2" data-image="<?php echo $image2['label']; ?>"><?php echo wp_get_attachment_image($image2['image'], 'full'); ?></div>
                        </div>
                      </div>
                      <p class="c-list-card__price --hero wf-oswald"> <span>PRICE ： ¥</span><span><?php the_field('price'); ?></span><span>&nbsp;+tax</span></p>
                      <div class="c-list-card__actions">
                        <div class="c-btn-round u-uppercase"><button class="--active box-shadow" data-image="<?php echo $image1['label']; ?>"><span> <?php echo $image1['label']; ?></span></button></div>
                        <div class="c-btn-round u-uppercase"><button class="box-shadow" data-image="<?php echo $image2['label']; ?>"><span> <?php echo $image2['label']; ?></span></button></div>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </section>
            <div class="p-products-overview">
              <div class="swiper">
                <div class="swiper-wrapper"><?php $images = get_field('prod-gallery');
                                            foreach ($images as $image) : ?><div class="swiper-slide">
                      <div class="p-products-overview__item">
                        <div class="p-products-overview__item-img"><?php echo wp_get_attachment_image($image['image'], 'slider'); ?></div>
                      </div>
                    </div><?php endforeach; ?></div>
                <div class="swiper-pagination"></div>
              </div><!-- リード文-->
              <div class="p-products-overview__lead wf-shippori-mincho"><?php the_content(); ?></div><!-- CTA-->
              <div class="p-products-overview__cta">
                <div class="c-btn-round u-uppercase --sp-large"><a href="<?php the_field('store_url'); ?>" target="_blank" rel="noopener noreferrer"> <span>ONLINE STORE</span></a></div>
              </div>
            </div>
          </div>
        </div>
      </main><?php get_footer(); ?>
    </div>
  </div>
</div>