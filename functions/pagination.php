<?php
function custom_pagination($query = null)
{
  if (!$query) {
    global $wp_query;
    $query = $wp_query;
  }

  // Get the total number of posts
  $total_posts = $query->found_posts;
  $posts_per_page = get_option('posts_per_page');

  // Calculate total pages based on original posts per page
  $total_pages = ceil($total_posts / $posts_per_page);

  if ($total_pages <= 1) {
    return;
  }

  $current_page = max(1, get_query_var('paged'));

  echo '<nav class="pagination">';
  echo '<ul class="pagination-list">';

  // First page
  if ($current_page > 1) {
    echo '<li class="pagination-item"><a href="' . esc_url(get_pagenum_link(1)) . '" class="pagination-link">1</a></li>';
  } else {
    echo '<li class="pagination-item"><span class="pagination-link current">1</span></li>';
  }

  // Calculate range of pages to show
  $range = 2; // Number of pages to show on each side of current page
  $start_page = max(2, $current_page - $range);
  $end_page = min($total_pages - 1, $current_page + $range);

  // Add ellipsis after first page if needed
  if ($start_page > 2) {
    echo '<li class="pagination-item"><span class="pagination-ellipsis">...</span></li>';
  }

  // Middle pages
  for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $current_page) {
      echo '<li class="pagination-item"><span class="pagination-link current">' . $i . '</span></li>';
    } else {
      echo '<li class="pagination-item"><a href="' . esc_url(get_pagenum_link($i)) . '" class="pagination-link">' . $i . '</a></li>';
    }
  }

  // Add ellipsis before last page if needed
  if ($end_page < $total_pages - 1) {
    echo '<li class="pagination-item"><span class="pagination-ellipsis">...</span></li>';
  }

  // Last page (always show)
  if ($current_page < $total_pages) {
    echo '<li class="pagination-item"><a href="' . esc_url(get_pagenum_link($total_pages)) . '" class="pagination-link">' . $total_pages . '</a></li>';
  } else if ($current_page == $total_pages) {
    echo '<li class="pagination-item"><span class="pagination-link current">' . $total_pages . '</span></li>';
  }

  echo '</ul>';
  echo '</nav>';
}

// Add some basic styles
function add_pagination_styles()
{
?>
  <style>
    .pagination {
      margin: 2rem 0;
    }

    .pagination-list {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
      justify-content: center;
      gap: 0.5rem;
    }

    .pagination-item {
      margin: 0;
    }

    .pagination-link {
      display: inline-block;
      padding: 0.5rem 1rem;
      text-decoration: none;
      border: 1px solid #ddd;
      border-radius: 4px;
      color: #333;
    }

    .pagination-link.current {
      background-color: #333;
      color: #fff;
      border-color: #333;
    }

    .pagination-ellipsis {
      display: inline-block;
      padding: 0.5rem;
    }
  </style>
<?php
}
// add_action('wp_head', 'add_pagination_styles');