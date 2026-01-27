<?php

/**
 * Template Name: 商品一覧
 */
?><?php get_header(); ?><div id="smooth-wrapper">
  <div id="smooth-content">
    <div class="l-wrapper">
      <main class="l-main">
        <div class="p-products-archive">
          <div class="l-inner">
            <section class="p-products-mv">
              <h1 class="p-products-mv__ttl c-subpage-ttl wf-oswald">PRODUCTS</h1>
            </section>
            <section class="p-products-list">
              <div class="c-list__inner"><?php if (have_posts()) : ?><ul class="c-list__list"><?php while (have_posts()) : the_post(); ?><li class="c-list__item"><?php setup_postdata($post);
                                                                                                                                                                  get_template_part('template-parts/product-card', 'products'); ?></li><?php endwhile;
                                                                                              wp_reset_postdata(); ?></ul><?php endif; ?></div>
            </section>
          </div>
        </div>
      </main><?php get_footer(); ?>
    </div>
  </div>
</div>