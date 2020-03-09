<?php if (defined('POPL_IS_START') === false){die();} ?>
<?php $POPL_VIEW_LAYOUT = "common.view.layout"; ?>
<h1><?= $bbs['title'] ?></h1>
<p>last modify : <?= $bbs['upsert_date'] ?></p>
<div>
    <?= $bbs['content'] ?>
</div>