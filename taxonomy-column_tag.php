<?php

/**
 * Template for column_tag taxonomy archive
 */

get_header(); ?>

<main class="ColumnArchive">
  <div class="header">
    <h1 class="title">
      THETA PEOPLE
    </h1>

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
        $current_term = get_queried_object();
        if (!empty($terms) && !is_wp_error($terms)) {
          foreach ($terms as $term) {
            $term_link = get_term_link($term);
            $active_class = ($current_term && $current_term->term_id === $term->term_id) ? ' active' : '';
            echo '<li class="filter_item' . $active_class . '"><a href="' . esc_url($term_link) . '">#' . esc_html($term->name) . '(' . intval($term->count) . ')</a></li>';
          }
        }
        ?>
      </ul>
    </div>

    <?php
    $term = get_queried_object();
    if (!empty($term) && isset($term->taxonomy) && $term->taxonomy === 'column_tag') {
      echo '<p class="tag">#' . esc_html($term->name) . '</p>';
    }
    ?>
  </div>

  <div class="content">
    <?php
    // 現在のタクソノミーターに属する投稿を取得
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        get_template_part('template-parts/column-card');
      }
    } else {
      echo '<p>該当するコラムが見つかりませんでした。</p>';
    }
    wp_reset_postdata();
    ?>
  </div>

  <?php
  // ページネーション
  global $wp_query;
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $max_pages = $wp_query->max_num_pages;

  if ($max_pages > 1) :
    $current_term = get_queried_object();
    $base_url = get_term_link($current_term);
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
</main>

<?php get_footer(); ?>