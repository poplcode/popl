<?php
require_once("../../popl/popl_core.php");
$bbs_id = popl_param_post("bbs_id", "r,n,min:1") or popl_response_redirect();
$edit_param = ['bbs_id'=>$bbs_id];
(popl_login_is_login() && popl_login_login_key() === $bbs_id) or popl_response_redirect_post("/edit.php", $edit_param);


$title = popl_param_post_san_html_remove("title", "r,minlen:1") or popl_response_redirect_post_flash("write.php", $edit_param, "제목은 1글자 이상입니다.");
$content = popl_param_post_san_html_encode("content", "r,minlen:10") or popl_response_redirect_post_flash("write.php", $edit_param, "컨텐츠는 10글자 이상입니다.");

popl_db_update_standard_by_id("anobbs", ["title"=>$title, "content"=>$content], $bbs_id) or popl_flash_set("데이터 저장 실패");
popl_login_logout();
popl_response_redirect("/content.php?bbs_id=" . $bbs_id);
