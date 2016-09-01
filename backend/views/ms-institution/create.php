<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsInstitution */

$this->title = 'บันทึกข้อมูลหน่วยงาน';
$this->params['breadcrumbs'][] = ['label' => 'Ms Institutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
$('#txt-header').text("<?= Html::encode($this->title) ?>");
</script>
<div class="ms-institution-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
