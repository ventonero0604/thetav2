<?php
/**
 * WordPress AJAX Handler for Load More Projects
 * このファイルをfunctions.phpでincludeしてください
 */

// AJAX action for logged-in users
add_action('wp_ajax_load_more_projects', 'handle_load_more_projects');
// AJAX action for non-logged-in users
add_action('wp_ajax_nopriv_load_more_projects', 'handle_load_more_projects');

function handle_load_more_projects() {
    // セキュリティチェック
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'load_more_projects_nonce')) {
        wp_die('Security check failed');
    }

    $page = intval($_POST['page'] ?? 1);
    $posts_per_page = intval($_POST['posts_per_page'] ?? 6);
    $page = max(1, $page);
    $offset = ($page - 1) * $posts_per_page;
    
    // プロジェクトの基本クエリ
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'orderby' => 'date',
        'order' => 'ASC',
        'post_status' => 'publish'
    );

    // data-tax / data-term を受け取り、tax_query を付与
    $tax       = isset($_POST['tax']) ? sanitize_text_field(wp_unslash($_POST['tax'])) : '';
    $term_raw  = isset($_POST['term']) ? wp_unslash($_POST['term']) : '';
    // URLエンコードされた非ASCIIスラッグにも対応
    $term_decoded = $term_raw !== '' ? rawurldecode($term_raw) : '';
    $term      = $term_decoded !== '' ? sanitize_title($term_decoded) : '';
    if ($tax && $term && taxonomy_exists($tax)) {
        $term_obj = get_term_by('slug', $term, $tax);
        if ($term_obj && ! is_wp_error($term_obj)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $tax,
                    'field'    => 'slug',
                    'terms'    => $term,
                ),
            );
        }
    }
    
    $query = new WP_Query($args);
    
    // ページネーション情報を取得（offset利用時は自前計算）
    $found = intval($query->found_posts);
    $max_pages = ($posts_per_page > 0) ? (int) ceil($found / $posts_per_page) : 1;
    $current_page = $page;
    $has_more = $current_page < $max_pages;

    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $pj_id = get_the_ID();
            $pj_url = get_the_permalink();
            $pj_title = get_the_title();
            $pj_date = get_the_date('Y/m/d');
            $pj_datetime = get_the_date('Y-m-d');
            $pj_place = get_field('pj_area');
            $pj_client = get_field('pj_client');
            // $pj_imgs = get_field('pj_images');
            $pj_imgs = SCF::get('ギャラリー', $pj_id);
            $pj_img = $pj_imgs[0]['pj-img'] ?? null;
            
            // 画像配列が存在しない場合の処理
            if (!is_array($pj_imgs)) {
                $pj_imgs = array();
            }
            $pj_design = get_field('pj_design');
            $pj_cats = get_the_terms($pj_id, 'projects-cat');
            ?>
            <div class="p-projects-items__item">
                <div class="c-card-projects --projects">
                    <div class="c-card-projects__img">
                        <?php if (count($pj_imgs) == 0) : ?>
                            <!-- 画像がない場合 -->
                        <?php elseif (count($pj_imgs) == 1) : ?>
                            <?php echo wp_get_attachment_image($pj_img, 'full'); ?>
                        <?php elseif (count($pj_imgs) > 1) : ?>
                            <div class="c-card-projects__swiper swiper" data-slider-id="slider-<?= $pj_id; ?>">
                                <div class="swiper-wrapper">
                                    <?php foreach ($pj_imgs as $img) : ?>
                                        <div class="swiper-slide">
                                            <div class="c-card-projects__slide-img">
                                                <?php echo wp_get_attachment_image($img['pj-img'], 'full'); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="c-card-projects__controls">
                                <button class="c-card-projects__controls--prev" aria-label="前の画像">
                                    <span class="c-card-projects__controls--btn">
                                        <?php 
                                        // Pugテンプレートと同じ構造でSVGアイコンを出力
                                        $chevron_left_svg = get_template_directory_uri() . '/assets/img/common/chevron-left.svg';
                                        echo '<picture><source srcset="' . $chevron_left_svg . '" type="image/svg+xml"><img src="' . $chevron_left_svg . '" alt="" width="6" height="10"></picture>';
                                        ?>
                                    </span>
                                </button>
                                <button class="c-card-projects__controls--next" aria-label="次の画像">
                                    <span class="c-card-projects__controls--btn">
                                        <?php 
                                        // Pugテンプレートと同じ構造でSVGアイコンを出力
                                        $chevron_right_svg = get_template_directory_uri() . '/assets/img/common/chevron-right.svg';
                                        echo '<picture><source srcset="' . $chevron_right_svg . '" type="image/svg+xml"><img src="' . $chevron_right_svg . '" alt="" width="6" height="10"></picture>';
                                        ?>
                                    </span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="c-card-projects__body --projects">
                        <h3 class="c-card-projects__shop">
                            <span class="c-card-projects__name"><?php echo $pj_title; ?></span>
                        </h3>
                        <div class="c-card-projects__meta">
                            <time class="c-card-projects__date" datetime="<?= $pj_datetime; ?>">
                                <?php echo $pj_date; ?>
                            </time>
                            <span class="c-card-projects__place"><?php echo $pj_place; ?></span>
                        </div>
                        <dl class="c-card-projects__credits">
                            <div class="c-card-projects__credit">
                                <dt class="c-card-projects__credit-key --projects">施主</dt>
                                <dd class="c-card-projects__credit-val"><?php echo $pj_client; ?></dd>
                            </div>
                            <div class="c-card-projects__credit">
                                <dt class="c-card-projects__credit-key --projects">設計</dt>
                                <dd class="c-card-projects__credit-val"><?php echo $pj_design; ?></dd>
                            </div>
                        </dl>
                        <ul class="c-card-projects__tags --projects">
                            <?php if ($pj_cats) : ?>
                                <?php foreach ($pj_cats as $cat) : ?>
                                    <li><a class="c-chip" href="<?= get_term_link($cat->term_id); ?>"><?= $cat->name; ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
    
    // ページネーション情報をHTMLコメントとして追加
    echo '<!-- PAGINATION_INFO: {"has_more": ' . ($has_more ? 'true' : 'false') . ', "current_page": ' . $current_page . ', "max_pages": ' . $max_pages . '} -->';
    
    wp_die();
}

// AJAX URLをJavaScriptで使用できるようにする
add_action('wp_enqueue_scripts', 'add_ajax_script');
function add_ajax_script() {
    wp_localize_script('jquery', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_projects_nonce')
    ));
}
