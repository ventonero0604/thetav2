<?php

/**
 * Archive template for 'event' post type
 * This template is used for /event/ and /event/page/2/ etc.
 */

global $wp_query;
get_header(); ?>

<main class="EventArchive">
  <div class="header">
    <h1 class="title">
      EVENT
    </h1>
  </div>

  <div class="content">
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      'post_type' => 'event',
      'post_status' => 'publish',
      'posts_per_page' => 8,
      'orderby' => 'date',
      'order' => 'DESC',
      'paged' => $paged,
      'ignore_sticky_posts' => true,
      'suppress_filters' => false,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $latest_image = get_field('image');
        $latest_year = get_field('year');
        $latest_date_start = get_field('date_start');
        $latest_date_end = get_field('date_end');
        $latest_brand = get_field('brand');
        $latest_tags = get_the_terms(get_the_ID(), 'event_tag');
        include(get_template_directory() . '/template-parts/event-card.php');
      }
    } else {
      echo '<p>イベントがありません。</p>';
    }
    wp_reset_postdata();
    ?>
  </div>

  <?php
  global $wp_query;
  $max_pages = $wp_query->max_num_pages;
  if ($max_pages > 1) :
    $base_url = get_post_type_archive_link('event');
    $pagination_base = user_trailingslashit(trailingslashit($base_url) . 'page/%#%');
  ?>
    <div class="pagenation">
      <?php if ($paged > 1) : ?>
        <?php $prev_url = ($paged == 2) ? $base_url : str_replace('%#%', $paged - 1, $pagination_base); ?>
        <a href="<?php echo esc_url($prev_url); ?>">＜</a>
      <?php endif; ?>
      <?php
      for ($i = 1; $i <= $max_pages; $i++) {
        $class = ($i === $paged) ? 'current' : '';
        $page_url = ($i == 1) ? $base_url : str_replace('%#%', $i, $pagination_base);
        echo '<a href="' . esc_url($page_url) . '" class="' . esc_attr($class) . '">' . intval($i) . '</a>';
      }
      ?>
      <?php if ($paged < $max_pages) : ?>
        <?php $next_url = str_replace('%#%', $paged + 1, $pagination_base); ?>
        <a href="<?php echo esc_url($next_url); ?>">＞</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</main>

<?php get_footer(); ?>