<?php
require_once("../../popl/popl_core.php");
$bbs_id = popl_param_get("bbs_id", "r,n,min:1") or popl_response_redirect();
$bbs = popl_db_select_first_by_id("anobbs",$bbs_id) or popl_response_redirect("content.php?bbs_id=$bbs_id");
?>
<form name="form" action="bbs_pw.form.php" method="post">
    <p>비밀번호 : <input type="password" name="bbs_pw" /></p>    
    <input type="hidden" name="bbs_id" value="<?= $bbs_id ?>" />
    <p><input type='submit' value="수정하기" /></p>
</form>
<?php popl_flash_show("<p>","</p>"); ?>