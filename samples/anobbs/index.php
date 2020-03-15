<?php
require_once("../../popl/popl_core.php");

$page_no = popl_param_get("page_no", "r,n,min:1", 1);
$bbs_list = popl_db_select_paging("anobbs", $page_no);
echo "<ul>";
foreach($bbs_list as $bbs){
?>
    <li><a href='/content.php?bbs_id=<?= $bbs["id"] ?>'><?= $bbs['title'] ?></a></li>
<?php } // end of foreach ?>
</ul>
<p><a href='write.php'>글쓰기</a></p>