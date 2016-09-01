<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Editorlog;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrnEduTestingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกสถิติ';
$this->screen_id = 'SC-004-02.01 : '.$this->title;
$this->params['breadcrumbs'][] = $this->title;
?>
 <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'institutionName.name_th',
            'objectiveName.name_th:text:วัตถุประสงค์ในการสอบ',
            'test_start:text:วันที่เริ่มสอบ',
            'test_end:text:สอบ ถึงวันที่',
            'count_examiner:text:จำนวนผู้สอบ',
            /*
            'trn_edu_testing_edu_level_id',
            'trn_edu_testing_edu_level_phase_id',
            'trn_edu_testing_test_set_id',
            'trn_edu_testing_lecturer_id',
            'contact_name',
            'contact_surname',
            'contact_mobile:text:โทร',
            'contact_office_phone:text:โทร',
            'contact_email:email:อีเมล',
            'contact_note:ntext',
            'status',
            'deleted',
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
            */
        ],
    ]) ?>
    <?php if(Yii::$app->session->hasFlash('alert')):?>
    <?=\yii\bootstrap\Alert::widget ( [ 'body' => ArrayHelper::getValue ( Yii::$app->session->getFlash ( 'alert' ), 'body' ),'options' => ArrayHelper::getValue ( Yii::$app->session->getFlash ( 'alert' ), 'options' ) ] )?>
<?php endif; ?>
<?php $form = ActiveForm::begin(); ?>	
<?=$form->field($model, 'status')->hiddenInput()->label(false)?>
<table class="table table-striped table-bordered"><thead>
<tr>
<th>ชื่อแบบทดสอบ</th>
<th>Min</th>
<th>Max</th>
<th>Mean</th>
<th>SD</th>
<th>Reli</th>
<th>SEM</th>
</tr>
</thead>
<tbody>
    <?php foreach ($oTest as $item){    ?>
    <tr>
    <td><?=$item->testSet->code_name?>
    <input type="hidden" name="id[]" value="<?=$item->id;?>">
    </td>
    <td><input type="text" name="min[]" value="<?=$item->mn;?>"></td>
    <td><input type="text" name="max[]" value="<?=$item->max;?>"></td>
    <td><input type="text" name="mean[]" value="<?=$item->mean;?>"></td>
    <td><input type="text" name="sd[]" value="<?=$item->sd;?>"></td>
    <td><input type="text" name="reli[]" value="<?=$item->reli;?>"></td>
    <td><input type="text" name="sem[]" value="<?=$item->sem;?>"></td>
    </tr>
    <?php } ?>
 </tbody></table>
 <div align="center"><button type="submit" class="btn btn-lg btn-success">บันทึก</button></div>
<?php ActiveForm::end(); ?>