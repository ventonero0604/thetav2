<?php

/**
 * Template Name: コラム詳細
 */
?><?php get_header(); ?>

<main class="ColumnDetail">
  <div class="content">
    <div class="header">
      <p class="tags">
        <?php
        $tags = get_the_terms(get_the_ID(), 'column_tag');
        if ($tags && !is_wp_error($tags)) {
          foreach ($tags as $tag) {
            echo '<span>#' . esc_html($tag->name) . '</span> ';
          }
        }
        ?>
      </p>

      <p class="date">
        <?php echo esc_html(get_the_date('Y.m.d')); ?>
      </p>

      <p class="name">
        <?php echo esc_html(get_field('name')); ?>
      </p>

      <h1 class="title">
        <?php echo esc_html(get_the_title()); ?>
      </h1>
    </div>

    <figure class="coverImage">
      <?php
      $cover_image = get_field('cover_image');
      if ($cover_image) {
        echo '<img src="' . esc_url($cover_image['url']) . '" alt="' . esc_attr(get_the_title()) . '">';
      }
      ?>
      <p class="coverImageText">
        <?php echo esc_html(get_field('cover_text')); ?>
      </p>
    </figure>

    <article class="article">
      <?php the_content(); ?>
    </article>

    <div class="profile">
      <div class="profile_name">
        <p class="profile_name_ja">
          <?php echo esc_html(get_field('name')); ?>
        </p>
        <p class="profile_name_en">
          <?php echo esc_html(get_field('name_en')); ?>
        </p>
      </div>
      <p class="profile_tag">
        <?php
        $tags = get_the_terms(get_the_ID(), 'column_tag');
        if ($tags && !is_wp_error($tags)) {
          foreach ($tags as $tag) {
            echo '<span>#' . esc_html($tag->name) . '</span> ';
          }
        }
        ?>
      </p>
      <p class="profile_text"><?php echo esc_html(get_field('profile_text')); ?></p>
      <?php
      $instagram = get_field('instagram');
      $x = get_field('x');
      $other_url_1_text = get_field('other_url_1_text');
      $other_url_1_url = get_field('other_url_1_url');
      $other_url_2_text = get_field('other_url_2_text');
      $other_url_2_url = get_field('other_url_2_url');

      if ($instagram || $x || $other_url_1_url || $other_url_2_url) {
        echo '<ul class="profile_sns">';

        if ($instagram) {
          echo '<li><a href="' . esc_url($instagram) . '">instagram</a></li>';
        }

        if ($x) {
          echo '<li><a href="' . esc_url($x) . '">X</a></li>';
        }

        if ($other_url_1_url && $other_url_1_text) {
          echo '<li><a href="' . esc_url($other_url_1_url) . '">' . esc_html($other_url_1_text) . '</a></li>';
        }

        if ($other_url_2_url && $other_url_2_text) {
          echo '<li><a href="' . esc_url($other_url_2_url) . '">' . esc_html($other_url_2_text) . '</a></li>';
        }

        echo '</ul>';
      }
      ?>
    </div>
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

  <?php
  $args = array(
    'post_type' => get_post_type(),
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
  );

  $query = new WP_Query($args);
  if ($query->have_posts()) {
    echo '<div class="archive">';
    while ($query->have_posts()) {
      $query->the_post();
      get_template_part('template-parts/column-card');
    }
    echo '</div>';
  }
  wp_reset_postdata();
  ?>

</main>

<?php get_footer(); ?>