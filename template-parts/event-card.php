<article class="Event_card">
  <a href="<?php echo esc_url(get_permalink()); ?>" class="EventCard_item">
    <?php if ($latest_image) { ?>
      <div class="EventCard_image">
        <img src="<?php echo esc_url($latest_image); ?>" alt="" />
      </div>
    <?php } ?>
    <div class="EventCard_texts">
      <p class="EventCard_type">#
        <?php
        if ($latest_tags && !is_wp_error($latest_tags)) {
          echo esc_html($latest_tags[0]->name);
        }
        ?>
      </p>
      <p class="EventCard_title">
        <?php echo esc_html($latest_brand); ?>
      </p>
      <p class="EventCard_date">
        <span><?php echo esc_html($latest_year); ?>.</span>
        <?php echo esc_html($latest_date_start); ?> –<br>
        <?php echo esc_html($latest_date_end); ?>
      </p>
      <span class="EventCard_arrow">
        →
      </span>
    </div>
  </a>
</article>