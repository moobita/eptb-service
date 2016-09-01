<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsSubjects */

 $this->title = 'บันทึกรายวิชา';
// $this->params['breadcrumbs'][] = ['label' => 'Ms Subjects', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<script>$('#txt-header').text("<?= Html::encode($this->title) ?>");</script>

<div class="ms-subjects-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
