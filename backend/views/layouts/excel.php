<?php $this->beginPage() ?>
<?php

use yii\helpers\Html;
use yii\helpers\Url;

header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="'.$this->filename.'.xls"');#ชื่อไฟล์
?>

<html xmlns:o="urn:schemas-microsoft-com:office:office"

xmlns:x="urn:schemas-microsoft-com:office:excel"

xmlns="http://www.w3.org/TR/REC-html40">

<HTML>

<HEAD>

<meta http-equiv="Content-type" content="text/html;charset=utf-8" />

</HEAD><BODY>

<TABLE  x:str BORDER="1">

<?=$content?>

</TABLE>

</BODY>

</HTML>
<?php $this->endPage() ?>