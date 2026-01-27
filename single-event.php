<?php

/**
 * Template Name: イベント詳細
 */
?><?php get_header(); ?>

<main class="EventDetail">
  <div class="content">
    <div class="header">
      <div class="tags">
        <?php
        $tags = get_the_terms(get_the_ID(), 'event_tag');
        if ($tags && !is_wp_error($tags)) {
          foreach ($tags as $tag) {
            echo '<span>#' . esc_html($tag->name) . '</span> ';
          }
        }
        ?>
      </div>

      <?php if ($event_image = get_field('image')) { ?>
        <div class="image">
          <img src="<?php echo esc_url($event_image); ?>" alt="" />
        </div>
      <?php } ?>

      <h1 class="title">
        <?php echo esc_html(get_field('brand')); ?>
      </h1>

      <p class="date">
        <span><?php echo esc_html(get_field('year')); ?>.</span><?php echo esc_html(get_field('date_start')); ?> – <?php echo esc_html(get_field('date_end')); ?>
      </p>

    </div>

    <div class="body">
      <?php the_content(); ?>
    </div>

    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    <ul class="pageNation">
      <li class="<?php echo empty($prev_post) ? 'disabled' : ''; ?>">
        <a href="<?php echo !empty($prev_post) ? get_permalink($prev_post->ID) : '#'; ?>">
          ←　PREV
        </a>
      </li>
      <li>
        <a href="<?php echo esc_url(get_post_type_archive_link(get_post_type())); ?>">
          ALL
        </a>
      </li>
      <li class="<?php echo empty($next_post) ? 'disabled' : ''; ?>">
        <a href="<?php echo !empty($next_post) ? get_permalink($next_post->ID) : '#'; ?>">
          NEXT　→
        </a>
      </li>
    </ul>
  </div>

  <div class="latest">
    <?php
    $args = array(
      'post_type' => 'event',
      'posts_per_page' => 2,
      'orderby' => 'date',
      'order' => 'DESC'
    );
    $latest_events = new WP_Query($args);

    if ($latest_events->have_posts()) {
      while ($latest_events->have_posts()) {
        $latest_events->the_post();
        $latest_image = get_field('image');
        $latest_year = get_field('year');
        $latest_date_start = get_field('date_start');
        $latest_date_end = get_field('date_end');
        $latest_brand = get_field('brand');
        $latest_tags = get_the_terms(get_the_ID(), 'event_tag');

        include(get_template_directory() . '/template-parts/event-card.php');
      }
      wp_reset_postdata();
    }
    ?>
  </div>
</main>

<?php get_footer();
