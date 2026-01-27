<?php

// Contact Form 7で自動挿入されるPタグ、brタグを削除（フォーム表示のみ）
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
  return false;
}
/*
// メール本文の改行を保持するためのフィルター
add_filter('wpcf7_mail_components', 'wpcf7_preserve_line_breaks_in_email', 10, 3);
function wpcf7_preserve_line_breaks_in_email($components, $contact_form, $mail)
{
  // メール本文の改行を保持
  if (isset($components['body'])) {
    $components['body'] = nl2br($components['body']);
  }

  return $components;
}
*/
/**
 * 1) 確認画面に"元の日本語ファイル名"を出す
 * 2) マルチステップで一時ファイルが消える問題を回避して確実に添付
 */
add_filter('wpcf7_posted_data', function ($data) {
  if (!empty($_FILES['resume']['name'])) {
    // ① 日本語の"元ファイル名"を保持（確認画面やメール本文で表示用）
    $data['resume-original-name'] = $_FILES['resume']['name'];

    // ② 一時ディレクトリへ退避（マルチステップで消えないように）
    $upload_dir  = wp_upload_dir();
    $tmp_dir     = trailingslashit($upload_dir['basedir']) . 'cf7-resume-tmp/';
    if (!file_exists($tmp_dir)) {
      wp_mkdir_p($tmp_dir);
    }

    // 退避先の実ファイル名（安全のため英数字で一意化）
    $ext      = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
    $safeBase = uniqid('resume_', true);
    $dest     = $tmp_dir . $safeBase . ($ext ? ('.' . $ext) : '');

    // PHP の一時ファイルから移動
    if (is_uploaded_file($_FILES['resume']['tmp_name']) && @move_uploaded_file($_FILES['resume']['tmp_name'], $dest)) {
      // 最終送信で添付するためにパスを保持
      $data['resume_saved_path'] = $dest;
    }
  }
  return $data;
});

/**
 * 最終送信直前に退避しておいたファイルを"確実に添付"
 * （File attachments に [resume] を入れていても、マルチステップで失われがちなので保険をかける）
 */
add_action('wpcf7_before_send_mail', function ($contact_form, &$abort) {
  $submission = WPCF7_Submission::get_instance();
  if (!$submission) return;

  $posted = $submission->get_posted_data();
  if (empty($posted['resume_saved_path']) || !file_exists($posted['resume_saved_path'])) return;

  $mail         = $contact_form->prop('mail');
  $attachments  = isset($mail['attachments']) ? $mail['attachments'] : '';
  $attachments .= "\n" . $posted['resume_saved_path'];
  $mail['attachments'] = trim($attachments);

  // 本文で日本語名を出したい場合のタグ（任意）： [resume-original-name]
  // 例）「添付書類： [resume-original-name]」

  $contact_form->set_properties(['mail' => $mail]);
}, 10, 2);

/**
 * 送信後に退避ファイルを掃除（サーバに溜めない）
 */
add_action('wpcf7_mail_sent', function ($contact_form) {
  $submission = WPCF7_Submission::get_instance();
  if (!$submission) return;
  $posted = $submission->get_posted_data();
  if (!empty($posted['resume_saved_path']) && file_exists($posted['resume_saved_path'])) {
    @unlink($posted['resume_saved_path']);
  }
});
add_filter('wpcf7_form_elements', function ($content) {
  $contact_form = WPCF7_ContactForm::get_current();
  if (!$contact_form || (int) $contact_form->id() !== 1234) { // ←1234を対象フォームIDに
    return $content;
  }
  $submission = WPCF7_Submission::get_instance();
  if (!$submission) return $content;

  $posted = $submission->get_posted_data();
  if (!empty($posted['resume-original-name'])) {
    $content = str_replace('[resume-original-name]', esc_html($posted['resume-original-name']), $content);
  }
  return $content;
});
