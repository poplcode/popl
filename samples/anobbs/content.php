<?php
require_once("../../popl/popl_core.php");
$bbs_id = popl_param_get("bbs_id", "r,n,min:1") or popl_response_redirect();
$bbs = popl_db_select_first_by_id("anobbs",$bbs_id) or popl_response_redirect();
popl_view("content.view", ["bbs"=>$bbs, "title"=>$bbs['title']]);