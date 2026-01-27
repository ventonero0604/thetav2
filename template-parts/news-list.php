<ul class="NewsList">
  <?php if (have_posts()): ?>
    <?php while (have_posts()):
      the_post(); ?>
      <li class="NewsList_item">
        <a class="NewsList_link" href="<?php the_permalink(); ?>">
          <div class="NewsList_texts">
            <div class="NewsList_meta">
              <p class="date"><?php echo get_the_date("Y.m.d"); ?></p>
              <p class="tag">
                <?php
                $tags = get_the_terms(get_the_ID(), "news_tag");
                if ($tags && !is_wp_error($tags)) {
                  foreach ($tags as $tag) {
                    echo "<span>#" . esc_html($tag->name) . "</span> ";
                  }
                }
                ?></p>
            </div>
            <h2 class="NewsList_title"><?php the_title(); ?></h2>
          </div>
        </a>
      </li>
    <?php
    endwhile; ?>
  <?php endif; ?>
</ul>
