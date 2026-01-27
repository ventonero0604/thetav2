<?php

/**
 * Template Name: ニュース詳細
 */
get_header(); ?>

<main class="NewsDetail">
  <div class="content">
    <div class="header">
      <div class="tags">
        <?php
        $tags = get_the_terms(get_the_ID(), "news_tag");
        if ($tags && !is_wp_error($tags)) {
          foreach ($tags as $tag) {
            echo "<span>#" . esc_html($tag->name) . "</span> ";
          }
        }
        ?>
      </div>

      <p class="date">
        <?php echo get_the_date("Y.m.d"); ?>
      </p>


      <h1 class="title">
        <?php the_title(); ?>
      </h1>
    </div>

    <div class="body">
      <?php the_content(); ?>
    </div>

    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    <ul class="pageNation">
      <li class="<?php echo empty($prev_post) ? "disabled" : ""; ?>">
        <a href="<?php echo !empty($prev_post) ? get_permalink($prev_post->ID) : "#"; ?>">
          ←　PREV
        </a>
      </li>
      <li>
        <a href="<?php echo esc_url(get_post_type_archive_link(get_post_type())); ?>">
          ALL
        </a>
      </li>
      <li class="<?php echo empty($next_post) ? "disabled" : ""; ?>">
        <a href="<?php echo !empty($next_post) ? get_permalink($next_post->ID) : "#"; ?>">
          NEXT　→
        </a>
      </li>
    </ul>
  </div>

</main>

<?php get_footer();
