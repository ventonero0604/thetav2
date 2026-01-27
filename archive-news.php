<?php

/**
 * Archive template for 'news' post type
 */
get_header(); ?>

<main class="NewsArchive">
  <div class="header">
    <h1 class="title">NEWS</h1>
  </div>
  <div class="content">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <article class="news-card">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
              <div class="news-card__thumb"><?php the_post_thumbnail('medium'); ?></div>
            <?php endif; ?>
            <div class="news-card__body">
              <h2 class="news-card__title"><?php the_title(); ?></h2>
              <div class="news-card__meta">
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
                <?php $cats = get_the_terms(get_the_ID(), 'news_category');
                if ($cats && !is_wp_error($cats)) {
                  foreach ($cats as $cat) {
                    echo '<span class="news-card__cat">' . esc_html($cat->name) . '</span>';
                  }
                } ?>
              </div>
              <div class="news-card__excerpt"><?php the_excerpt(); ?></div>
            </div>
          </a>
        </article>
      <?php endwhile; ?>
      <div class="pagenation">
        <?php
        global $wp_query;
        $big = 999999999;
        echo paginate_links(array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format' => '/page/%#%/',
          'current' => max(1, get_query_var('paged')),
          'total' => $wp_query->max_num_pages,
          'prev_text' => '＜',
          'next_text' => '＞',
        ));
        ?>
      </div>
    <?php else : ?>
      <p>ニュースがありません。</p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>