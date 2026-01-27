<?php

/**
 * Archive template for 'news' post type
 */
get_header(); ?>

<main class="NewsArchive">
  <div class="header">
    <h1 class="title">NEWS</h1>
  </div>
  <?php get_template_part("template-parts/news-list"); ?>

  <?php
  global $wp_query;
  $paged = get_query_var("paged") ? get_query_var("paged") : 1;
  $max_pages = $wp_query->max_num_pages;

  if ($max_pages > 1):

    $base_url = get_post_type_archive_link("news");
    $pagination_base = user_trailingslashit(trailingslashit($base_url) . "page/%#%");
    ?>
    <div class="pagenation">
      <?php if ($paged > 1): ?>
        <?php $prev_url = $paged == 2 ? $base_url : str_replace("%#%", $paged - 1, $pagination_base); ?>
        <a href="<?php echo esc_url($prev_url); ?>">＜</a>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $max_pages; $i++) {
        $class = $i === $paged ? "current" : "";
        $page_url = $i == 1 ? $base_url : str_replace("%#%", $i, $pagination_base);
        echo '<a href="' . esc_url($page_url) . '" class="' . esc_attr($class) . '">' . intval($i) . "</a>";
      } ?>
      <?php if ($paged < $max_pages): ?>
        <?php $next_url = str_replace("%#%", $paged + 1, $pagination_base); ?>
        <a href="<?php echo esc_url($next_url); ?>">＞</a>
      <?php endif; ?>
    </div>
  <?php
  endif;
  ?>

</main>

<?php get_footer(); ?>
