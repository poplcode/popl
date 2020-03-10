<?php
require_once("../../popl/popl_core.php");
popl_view_layout_direct_start();
?>
<form name="write" action="write.form.php" method="post">
    <p>제목 : <input type='text' name="title" style='width:80%;' /></p>
    <p>내용 : <textarea name="content" rows="5" style='width:80%;'></textarea></p>
    <p><input type='submit' value="저장하기" />
</form>
<?php popl_flash_show("<p>","</p>"); ?>
<?php
popl_view_layout_direct_end("common.view.layout", ['title'=> '글쓰기']);
?>