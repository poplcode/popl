<?php
require_once("../../popl/popl_core.php");

$page_no = popl_param_get("page_no", "r,n,min:1", 1);
$bbs_list = popl_db_select_paging("anobbs", $page_no);
foreach($bbs_list as $bbs){
?>
    <p><a href='/content.php?bbs_id=<?= $bbs["id"] ?>'><?= $bbs['title'] ?></a></p>
<?php } // end of foreach ?>
