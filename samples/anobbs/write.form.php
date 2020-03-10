<?php
require_once("../../popl/popl_core.php");
popl_valid_http_method_post() or popl_response_redirect("write.php");

$title = popl_param_post_san_html_remove("title", "r,minlen:1") or popl_response_redirect_flash("write.php", "제목은 1글자 이상입니다.");
$content = popl_param_post_san_html_encode("content", "r,minlen:10") or popl_response_redirect_flash("write.php", "컨텐츠는 10글자 이상입니다.");

$last_id = popl_db_insert_standard("anobbs", ["title"=>$title, "content"=>$content]) or popl_response_redirect("write.php");
popl_response_redirect("content.php?bbs_id=" . $last_id);