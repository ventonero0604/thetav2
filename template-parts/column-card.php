<article class="Column_card">
  <a href="<?php echo esc_url(get_permalink()); ?>">
    <figure class="Column_card_image">
      <?php
      $thumbnail = get_field('thumbnail');
      if ($thumbnail) {
        echo '<img src="' . esc_url($thumbnail['url']) . '" alt="' . esc_attr(get_the_title()) . '">';
      }
      ?>
    </figure>
    <div class="Column_card_info">
      <p class="Column_card_date">
        <?php echo esc_html(get_the_date('Y.m.d')); ?>
      </p>
      <p class="Column_card_tag">
        <?php
        $tags = get_the_terms(get_the_ID(), 'column_tag');
        if ($tags && !is_wp_error($tags)) {
          foreach ($tags as $tag) {
            echo '<span>#' . esc_html($tag->name) . '</span> ';
          }
        }
        ?>
      </p>
      <p class="Column_card_name">
        <?php echo esc_html(get_field('name')); ?>
      </p>
      <p class="Column_card_title">
        <?php echo esc_html(get_the_title()); ?>
      </p>
    </div>
  </a>
</article>