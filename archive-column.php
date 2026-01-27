<?php

/**
 * Archive template for 'column' post type
 * This template is used for /column/ and /column/page/2/ etc.
 */

global $wp_query;
get_header(); ?>

<main class="ColumnArchive">
  <div class="header">
    <h1 class="title">
      MAGAZINE
    </h1>

    <div class="latest">
      <p class="latest_title">
        NEW POST
      </p>
      <div class="latest_card">
        <?php
        $latest_args = array(
          'post_type' => 'column',
          'posts_per_page' => 1,
          'orderby' => 'date',
          'order' => 'DESC',
        );
        $latest_query = new WP_Query($latest_args);
        if ($latest_query->have_posts()) {
          while ($latest_query->have_posts()) {
            $latest_query->the_post();
            get_template_part('template-parts/column-card');
          }
        }
        wp_reset_postdata();
        ?>
      </div>
    </div>

    <div class="filter">
      <div class="filter_header">
        <p class="filter_title">
          Category
        </p>
        <a href="<?php echo esc_url(get_post_type_archive_link('column')); ?>" class="filter_button">
          絞り込みを解除
        </a>
      </div>
      <ul class="filter_list">
        <?php
        $terms = get_terms(array(
          'taxonomy' => 'column_tag',
          'hide_empty' => true,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
          foreach ($terms as $term) {
            $term_link = get_term_link($term, 'column_tag');
            if (!is_wp_error($term_link)) {
              echo '<li class="filter_item"><a href="' . esc_url($term_link) . '">#' . esc_html($term->name) . '(' . intval($term->count) . ')</a></li>';
            }
          }
        }
        ?>
      </ul>
    </div>

    <p class="posts_title">
      ALL POSTS
    </p>

    <?php
    $term = get_queried_object();
    if (!empty($term) && isset($term->taxonomy) && $term->taxonomy === 'column_tag') {
      echo '<p class="tag">#' . esc_html($term->name) . '</p>';
    }
    ?>
  </div>

  <div class="content">

    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = array(
      'post_type' => get_post_type(),
      'post_status' => 'publish',
      'posts_per_page' => 10,
      'orderby' => 'date',
      'order' => 'DESC',
      'paged' => $paged,
      'ignore_sticky_posts' => true,
      'suppress_filters' => false,
    );

    if (is_tax('column_tag')) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'column_tag',
          'field' => 'slug',
          'terms' => get_query_var('term'),
        ),
      );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        echo '<!-- Post ID: ' . get_the_ID() . ', Title: ' . get_the_title() . ', Type: ' . get_post_type() . ' -->';
        get_template_part('template-parts/column-card');
      }
    } else {
      echo '<p>投稿が見つかりませんでした。</p>';
    }
    wp_reset_postdata();
    ?>

  </div>

  <?php
  $max_pages = $query->max_num_pages;

  if ($max_pages > 1) :
    // 現在のURLベースを取得
    if (is_tax('column_tag')) {
      $current_term = get_queried_object();
      $base_url = get_term_link($current_term);
    } else {
      $base_url = get_post_type_archive_link('column');
    }

    // ページネーション用のベースURLを生成
    $pagination_base = user_trailingslashit(trailingslashit($base_url) . 'page/%#%');
  ?>
    <div class="pagenation">
      <?php if ($paged > 1) : ?>
        <?php
        $prev_url = ($paged == 2) ? $base_url : str_replace('%#%', $paged - 1, $pagination_base);
        ?>
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
        <?php
        $next_url = str_replace('%#%', $paged + 1, $pagination_base);
        ?>
        <a href="<?php echo esc_url($next_url); ?>">＞</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</main>｀

<?php get_footer(); ?>