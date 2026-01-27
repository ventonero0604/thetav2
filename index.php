<?php
// カスタム投稿タイプのアーカイブページの場合は適切なテンプレートを読み込む
if (is_post_type_archive('column') || (get_query_var('post_type') === 'column')) {
    echo '<!-- DEBUG: Redirecting to archive-column.php from index.php -->';
    echo '<!-- DEBUG: post_type query var: ' . get_query_var('post_type') . ' -->';
    echo '<!-- DEBUG: paged query var: ' . get_query_var('paged') . ' -->';

    include(get_template_directory() . '/archive-column.php');
    return;
}

get_header(); ?><a class="p-top-bnr" href="https://theta-online.jp/theta_tgc/" target="_blank" rel="noopener noreferrer">
  <picture>
    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/bnr/bnr-251126.webp" type="image/webp" />
    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/bnr/bnr-251126.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/bnr/bnr-251126.png" alt="ヒロマツホールディングスTGC　THETA DEBUT" width="580" height="640" loading="lazy" />
  </picture>
</a>
<div class="p-top-mv">
  <div class="p-top-mv__inner">
    <div class="p-top-mv__logo"><svg id="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 210.65 382.4">
        <defs>
          <mask id="logo-mask" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse">
            <path id="mask-1-1" class="logo-mask" d="M158.92,154.05v-50c0-24.28-21.93-51.48-53.63-51.48-35.13,0-53.24,30.64-53.24,51.1v87.12h106.21v87.72c0,26.76-23.47,51.45-52.39,51.45-30.41,0-53.82-25.29-53.82-50.32v-52.11" />
            <path id="mask-2-1" class="logo-mask" d="M180.54,154.05v-52.92c0-24.09-22.55-70.78-75.25-70.78S29.49,73.78,29.49,103.18v175.76c0,29.18,26.37,72.79,75.99,72.79,46.38,0,75.06-39.77,75.06-77.04v-91.57" />
            <line id="mask-2-2" class="logo-mask" x1="31.36" y1="212.85" x2="142.99" y2="212.85" />
            <path id="mask-3-1" class="logo-mask" d="M202.65,154.34v-50.76c0-57.19-50.81-95.59-96.18-95.59C56,8,8,47.35,8,102.96v175.06c0,54.4,47.72,95.6,97.01,95.6s97.64-38.27,97.64-101.52v-103.2l-135.93-.29" />
          </mask>
        </defs>
        <g id="logo-base" mask="url(#logo-mask)">
          <path id="logo-base-3" data-name="パス 1776" class="logo-color" d="M209.75,154.05v-48.67C209.75,47.69,162.98.93,105.3.93S.84,47.69.84,105.38v170.82c0,57.69,46.77,104.45,104.45,104.45s104.45-46.77,104.45-104.45v-114.55H66.72v14.37h128.66v100.18c0,49.75-40.33,90.08-90.08,90.08S15.21,325.95,15.21,276.2V105.38C15.21,55.63,55.55,15.3,105.3,15.3s90.08,40.33,90.08,90.08v48.67h14.37Z" />
          <path id="logo-base-1" data-name="パス 1777" class="logo-color" d="M165.83,154.05v-48.67c-.14-33.43-27.35-60.42-60.78-60.29-33.24.13-60.15,27.05-60.29,60.29v92.6h106.7v78.22c.12,25.49-20.45,46.26-45.95,46.38-25.49.12-46.26-20.45-46.38-45.95,0-.14,0-.29,0-.43v-48.67h-14.37v48.67c-.14,33.43,26.85,60.64,60.29,60.78s60.64-26.85,60.78-60.29c0-.16,0-.33,0-.49v-92.59H59.13v-78.22c.12-25.49,20.88-46.07,46.38-45.95,25.33.12,45.83,20.62,45.95,45.95v48.67h14.37Z" />
          <path id="logo-base-2" data-name="パス 1778" class="logo-color" d="M187.79,154.05v-48.67c0-45.56-36.94-82.49-82.49-82.49-45.56,0-82.49,36.93-82.49,82.49v170.82c0,45.56,36.93,82.49,82.49,82.49,45.56,0,82.49-36.93,82.49-82.49h0v-92.6h-14.37v92.59c0,37.62-30.5,68.12-68.12,68.12s-68.12-30.5-68.12-68.12v-56.26h105v-14.37H37.17v-100.18c0-37.62,30.5-68.12,68.12-68.12s68.12,30.5,68.12,68.12v48.67h14.37Z" />
        </g>
      </svg></div>
    <div class="p-top-mv__logo-type"> <svg id="logo-type" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 465.24 113.75">
        <path id="logo-type-5" class="logo-type" d="M17.38,113.75V21.04H0V0h57.58v21.04h-17.38v92.71h-22.83Z" />
        <path id="logo-type-4" class="logo-type" d="M100.98,113.75V0h22.44v42.07h25.4V0h22.67v113.75h-22.67v-49.47h-25.4v49.47h-22.44Z" />
        <path id="logo-type-3" class="logo-type" d="M214.9,113.75V0h47.84v21.04h-25.86v22.98h23.45v20.88h-23.45v26.65h25.86v22.2h-47.84Z" />
        <path id="logo-type-2" class="logo-type" d="M323.51,113.75V21.04h-17.37V0h57.58v21.04h-17.38v92.71h-22.82Z" />
        <path id="logo-type-1" class="logo-type" d="M389.74,113.75L416.23,0h23.76l25.25,113.75h-22.68l-3.82-19.95h-22.83l-3.5,19.95h-22.68ZM420.05,76.12h15.12c-1.56-7.95-2.96-16.27-4.21-24.97-1.25-8.7-2.34-17.88-3.27-27.54-1.14,8.52-2.35,17.15-3.62,25.91-1.27,8.75-2.61,17.62-4.01,26.6" />
      </svg></div>
  </div>
  <div class="p-top-mv__logo-2"><svg id="logo2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 210.65 382.4">
      <defs>
        <mask id="logo-mask2" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse">
          <path id="mask-1-1-2" class="logo-mask" d="M158.92,154.05v-50c0-24.28-21.93-51.48-53.63-51.48-35.13,0-53.24,30.64-53.24,51.1v87.12h106.21v87.72c0,26.76-23.47,51.45-52.39,51.45-30.41,0-53.82-25.29-53.82-50.32v-52.11" />
          <path id="mask-2-1-2" class="logo-mask" d="M180.54,154.05v-52.92c0-24.09-22.55-70.78-75.25-70.78S29.49,73.78,29.49,103.18v175.76c0,29.18,26.37,72.79,75.99,72.79,46.38,0,75.06-39.77,75.06-77.04v-91.57" />
          <line id="mask-2-2-2" class="logo-mask" x1="31.36" y1="212.85" x2="142.99" y2="212.85" />
          <path id="mask-3-1-2" class="logo-mask" d="M202.65,154.34v-50.76c0-57.19-50.81-95.59-96.18-95.59C56,8,8,47.35,8,102.96v175.06c0,54.4,47.72,95.6,97.01,95.6s97.64-38.27,97.64-101.52v-103.2l-135.93-.29" />
        </mask>
      </defs>
      <g id="logo-base2" mask="url(#logo-mask2)">
        <path id="logo-base-3-2" data-name="パス 1776" class="logo-color" d="M209.75,154.05v-48.67C209.75,47.69,162.98.93,105.3.93S.84,47.69.84,105.38v170.82c0,57.69,46.77,104.45,104.45,104.45s104.45-46.77,104.45-104.45v-114.55H66.72v14.37h128.66v100.18c0,49.75-40.33,90.08-90.08,90.08S15.21,325.95,15.21,276.2V105.38C15.21,55.63,55.55,15.3,105.3,15.3s90.08,40.33,90.08,90.08v48.67h14.37Z" />
        <path id="logo-base-1-2" data-name="パス 1777" class="logo-color" d="M165.83,154.05v-48.67c-.14-33.43-27.35-60.42-60.78-60.29-33.24.13-60.15,27.05-60.29,60.29v92.6h106.7v78.22c.12,25.49-20.45,46.26-45.95,46.38-25.49.12-46.26-20.45-46.38-45.95,0-.14,0-.29,0-.43v-48.67h-14.37v48.67c-.14,33.43,26.85,60.64,60.29,60.78s60.64-26.85,60.78-60.29c0-.16,0-.33,0-.49v-92.59H59.13v-78.22c.12-25.49,20.88-46.07,46.38-45.95,25.33.12,45.83,20.62,45.95,45.95v48.67h14.37Z" />
        <path id="logo-base-2-2" data-name="パス 1778" class="logo-color" d="M187.79,154.05v-48.67c0-45.56-36.94-82.49-82.49-82.49-45.56,0-82.49,36.93-82.49,82.49v170.82c0,45.56,36.93,82.49,82.49,82.49,45.56,0,82.49-36.93,82.49-82.49h0v-92.6h-14.37v92.59c0,37.62-30.5,68.12-68.12,68.12s-68.12-30.5-68.12-68.12v-56.26h105v-14.37H37.17v-100.18c0-37.62,30.5-68.12,68.12-68.12s68.12,30.5,68.12,68.12v48.67h14.37Z" />
      </g>
    </svg></div>
</div>
<div class="p-top-mv__slider">
  <div class="p-top-mv__logo-type-2"> <svg id="logo-type-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1299.41 317.7">
      <path id="_パス_1970" data-name="パス 1970" class="logo-type-2__path" d="M48.53,317.7V58.77H0V0h160.81v58.76h-48.53v258.93h-63.75Z" />
      <path id="_パス_1971" data-name="パス 1971" class="logo-type-2__path" d="M282.05,317.7V0h62.67v117.5h70.94V0h63.31v317.7h-63.31v-138.17h-70.94v138.17h-62.67Z" />
      <path id="_パス_1972" data-name="パス 1972" class="logo-type-2__path" d="M600.21,317.7V0h133.6v58.77h-72.24v64.19h65.49v58.31h-65.49v74.42h72.24v62.02h-133.6Z" />
      <path id="_パス_1973" data-name="パス 1973" class="logo-type-2__path" d="M903.58,317.7V58.77h-48.53V0h160.81v58.76h-48.54v258.93h-63.75Z" />
      <path id="_パス_1974" data-name="パス 1974" class="logo-type-2__path" d="M1088.56,317.7L1162.54,0h66.37l70.5,317.7h-63.32l-10.67-55.71h-63.75l-9.78,55.71h-63.33ZM1173.21,212.6h42.22c-4.35-22.2-8.27-45.44-11.76-69.74-3.48-24.3-6.52-49.94-9.13-76.93-3.19,23.79-6.56,47.91-10.12,72.35-3.57,24.45-7.3,49.22-11.21,74.31" />
    </svg></div>
  <div class="p-top-mv__slides">
    <div class="p-top-mv__bg p-top-mv__slide --original"><video src="<?php echo get_template_directory_uri(); ?>/assets/img/top/test1_1.mp4" autoplay muted loop playsinline></video></div>
    <div class="p-top-mv__slide --more --more-1">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-2.webp" type="image/webp" />
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-2.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-2.png" alt="webp" width="1080" height="1620" loading="lazy" />
      </picture>
    </div>
    <div class="p-top-mv__slide --more --more-2">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-3.webp" type="image/webp" />
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-3.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-3.png" alt="webp" width="1080" height="1620" loading="lazy" />
      </picture>
    </div>
    <div class="p-top-mv__slide --more --more-3">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-4.webp" type="image/webp" />
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-4.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/top-slide-4.png" alt="webp" width="1078" height="1620" loading="lazy" />
      </picture>
    </div>
  </div>
</div>
<div id="smooth-wrapper">
  <div id="smooth-content">
    <div class="l-wrapper">
      <main class="l-main">
        <div class="p-top-mv__wrapper"></div>
        <div class="p-top-concept">
          <p class="p-top-concept__desc wf-shippori-mincho --en"> Silent, yet present—<br> leaving space for place and time.</p>
          <p class="p-top-concept__desc wf-shippori-mincho">『それ』は語らずそこにあり、<br class="sp-only">その場所、その時を余白する。<br>技を見せるのではなく、 <br class="sp-only">余白として残すこと―― <br>それがTHETA θの美学です。</p>
        </div>
        <div class="p-top-products">
          <h2 class="p-top-products__ttl u-uppercase wf-oswald c-ttl-top">Theta Products </h2>
          <div class="p-top-products-list">
            <div class="p-top-products-list__item">
              <div class="p-top-products-list__info">
                <h3 class="p-top-products-list__ttl wf-oswald filter-shadow u-uppercase">2P/Suvin<br>Cotton<br>Tee</h3>
                <div class="c-btn-round u-uppercase --arrow --left"><a class="box-shadow" href="/products/suvin-cotton-tee" aria-label="Read More"></a></div>
                <div class="p-top-products-list__image --img1" data-para-depth="-0.5">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-1.webp" type="image/webp" />
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-1.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-1.png" alt="" width="1260" height="1140" loading="lazy" />
                  </picture>
                </div>
              </div>
              <div class="p-top-products-list__scene" data-para-depth="1">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-1.webp" type="image/webp" />
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-1.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-1.png" alt="" width="1186" height="1778" loading="lazy" />
                </picture>
              </div>
            </div>
            <div class="p-top-products-list__item">
              <div class="p-top-products-list__info">
                <h3 class="p-top-products-list__ttl wf-oswald filter-shadow u-uppercase">Boxy<br>Tee/M</h3>
                <div class="c-btn-round u-uppercase --arrow --left"><a class="box-shadow" href="/products/boxy-tee-m" aria-label="Read More"></a></div>
                <div class="p-top-products-list__image --img2" data-para-depth="-0.5">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-2.webp" type="image/webp" />
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-2.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-2.png" alt="" width="1260" height="1140" loading="lazy" />
                  </picture>
                </div>
              </div>
              <div class="p-top-products-list__scene" data-para-depth="1">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-2.webp" type="image/webp" />
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-2.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-2.png" alt="" width="1186" height="1778" loading="lazy" />
                </picture>
              </div>
            </div>
            <div class="p-top-products-list__item">
              <div class="p-top-products-list__info">
                <h3 class="p-top-products-list__ttl wf-oswald filter-shadow u-uppercase">Boxy<br>Tee/W</h3>
                <div class="c-btn-round u-uppercase --arrow --left"><a class="box-shadow" href="/products/boxy-tee-w" aria-label="Read More"></a></div>
                <div class="p-top-products-list__image --img3" data-para-depth="-0.5">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-3.webp" type="image/webp" />
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-3.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-3.png" alt="" width="1260" height="1140" loading="lazy" />
                  </picture>
                </div>
              </div>
              <div class="p-top-products-list__scene" data-para-depth="1">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-3.webp" type="image/webp" />
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-3.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-3.png" alt="" width="1186" height="1778" loading="lazy" />
                </picture>
              </div>
            </div>
            <div class="p-top-products-list__item">
              <div class="p-top-products-list__info">
                <h3 class="p-top-products-list__ttl wf-oswald filter-shadow u-uppercase">Zip-up<br>Hoodie</h3>
                <div class="c-btn-round u-uppercase --arrow --left"><a class="box-shadow" href="/products/zip-up-hoodie" aria-label="Read More"></a></div>
                <div class="p-top-products-list__image --img4" data-para-depth="-0.5">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-4.webp" type="image/webp" />
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-4.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-4.png" alt="" width="1260" height="1140" loading="lazy" />
                  </picture>
                </div>
              </div>
              <div class="p-top-products-list__scene" data-para-depth="1">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-4.webp" type="image/webp" />
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-4.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-4.png" alt="" width="1202" height="1806" loading="lazy" />
                </picture>
              </div>
            </div>
            <div class="p-top-products-list__item">
              <div class="p-top-products-list__info">
                <h3 class="p-top-products-list__ttl wf-oswald filter-shadow u-uppercase">Jogger<br>Pants</h3>
                <div class="c-btn-round u-uppercase --arrow --left"><a class="box-shadow" href="/products/jogger-pants" aria-label="Read More"></a></div>
                <div class="p-top-products-list__image --img5" data-para-depth="-0.5">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-5.webp" type="image/webp" />
                    <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-5.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-prod-5.png" alt="" width="1260" height="1140" loading="lazy" />
                  </picture>
                </div>
              </div>
              <div class="p-top-products-list__scene" data-para-depth="1">
                <picture>
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-5.webp" type="image/webp" />
                  <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-5.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-scene-5.png" alt="" width="1186" height="1778" loading="lazy" />
                </picture>
              </div>
            </div>
          </div>
        </div>
        <div class="p-top-space">
          <h2 class="p-top-space__ttl u-uppercase wf-oswald c-ttl-top">Theta Space </h2>
          <div class="p-top-space__img">
            <div class="p-top-space__img-inner">
              <picture>
                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-top-space.webp" type="image/webp" />
                <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-top-space.png" type="image/png" /><img src="<?php echo get_template_directory_uri(); ?>/assets/img/top/img-top-space.png" alt="" width="4328" height="2980" loading="lazy" />
              </picture>
            </div>
          </div>
        </div>
      </main><?php get_footer(); ?>
    </div>
  </div>
</div>