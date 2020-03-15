<?php
require_once("../../popl/popl_core.php");
popl_valid_http_method_post() or popl_response_redirect();
$bbs_id = popl_param_post("bbs_id", "r,n,min:1") or popl_response_redirect();
$bbs_pw = popl_param_post("bbs_pw", "r,minlen:4") or popl_response_redirect("/content.php?bbs_id=" . $bbs_id);
$bbs = popl_db_select_first_by_id("anobbs",$bbs_id) or popl_response_redirect();
if (! popl_password_match($bbs_pw, $bbs['bbs_pw'])){
    popl_response_redirect_flash("/bbs_pw.php?bbs_id=" . $bbs_id, "비밀번호 불일치");    
}

popl_login_login($bbs_id);
popl_response_redirect("edit.php?bbs_id=$bbs_id");