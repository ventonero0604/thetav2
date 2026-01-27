<article class="c-list-card">
  <div class="c-list-card__flex">
    <div class="c-list-card__inner">
      <h2 class="c-list-card__title wf-oswald"><?php the_title(); ?></h2>
    </div>
    <div class="c-list-card__images">
      <div class="c-list-card__img"><?php the_post_thumbnail('full'); ?></div>
    </div>
  </div>
  <p class="c-list-card__price wf-oswald"> <span>PRICE ： ¥</span><span><?php the_field('price'); ?></span><span>+tax</span></p>
  <div class="c-list-card__actions">
    <div class="c-btn-round u-uppercase"><a class="box-shadow" href="<?php the_permalink(); ?>"><span>Read More</span></a></div>
    <div class="c-btn-round u-uppercase"><a class="box-shadow" href="<?php the_field('store_url'); ?>" target="_blank" rel="noopener noreferrer"><span>Online Store</span></a></div>
  </div>
</article>