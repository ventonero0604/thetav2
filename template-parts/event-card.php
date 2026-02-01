<?php
$latest_image = isset($latest_image) ? $latest_image : get_field("image");
$latest_year = isset($latest_year) ? $latest_year : get_field("year");
$latest_date_start = isset($latest_date_start) ? $latest_date_start : get_field("date_start");
$latest_date_end = isset($latest_date_end) ? $latest_date_end : get_field("date_end");
$latest_brand = isset($latest_brand) ? $latest_brand : get_field("brand");
$latest_tags = isset($latest_tags) ? $latest_tags : get_the_terms(get_the_ID(), "event_tag");
?>
<article class="EventCard">
  <a href="<?php echo esc_url(get_permalink()); ?>" class="EventCard_item">
    <?php if ($latest_image) { ?>
      <div class="EventCard_image">
        <img src="<?php echo esc_url($latest_image); ?>" alt="" />
      </div>
    <?php } ?>
    <div class="EventCard_texts">
      <p class="EventCard_type">#
        <?php if ($latest_tags && !is_wp_error($latest_tags)) {
          echo esc_html($latest_tags[0]->name);
        } ?>
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