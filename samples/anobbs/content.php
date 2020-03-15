<?php
require_once("../../popl/popl_core.php");
$bbs_id = popl_param_get("bbs_id", "r,n,min:1") or popl_response_redirect();
$bbs = popl_db_select_first_by_id("anobbs",$bbs_id) or popl_response_redirect();
$title = $bbs['title'];
$content = popl_str_wrap_each_lines($bbs['content'], "<p>","</p>");
popl_view_layout_direct_start();

?>
<h1><?= $title ?></h1>
<p>last modify : <?= $bbs['upsert_date'] ?></p>
<div>
    <?= $content ?>
</div>
<hr />
<h3>수정</h3>
<a href="bbs_pw.php?bbs_id=<?= $bbs_id ?>">수정하기</a>
<?php popl_flash_show("<p>","</p>"); ?>
<?php
popl_view_layout_direct_end("common.view.layout", ['title'=> $title]);
?>