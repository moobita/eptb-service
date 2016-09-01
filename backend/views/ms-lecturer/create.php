<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsLecturer */

 $this->title = 'บันทึกข้อมูลวิทยากร';
// $this->params['breadcrumbs'][] = ['label' => 'Ms Lecturers', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<script>$('#txt-header').text("<?= Html::encode($this->title) ?>");</script>

<div class="ms-lecturer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
