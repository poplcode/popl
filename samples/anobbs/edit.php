<?php
require_once("../../popl/popl_core.php");
$bbs_id = popl_param_get("bbs_id", "r,n,min:1") or popl_response_redirect();
$bbs = popl_db_select_first_by_id("anobbs",$bbs_id) or popl_response_redirect("bbs_pw.php?bbs_id=$bbs_id");

$title = $bbs['title'];
$content = $bbs['content'];

popl_view_layout_direct_start();
?>
<h1>수정하기</h1>
<form name="form" action="edit.form.php" method="post">
    <p>제목 : <input type='text' name="title" style='width:80%;' value="<?= $title ?>" /></p>
    <p>내용 : <textarea name="content" rows="5" style='width:80%;'><?= $content ?></textarea></p>
    <input type="hidden" name="bbs_id" value="<?= $bbs_id ?>" />
    <p><input type='submit' value="저장하기" /></p>
</form>
<?php 
popl_flash_show("<p>","</p>");
popl_view_layout_direct_end("common.view.layout", ['title'=> '글 수정 :: ' . $title]);
?>