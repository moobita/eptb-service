<?php
use yii\widgets\DetailView;
?>

<div class="ms-institution-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'ประเภทหน่วยงาน',
                'value' => $model->typeId->name_th,
            ],
            [
            'label' => 'ชื่อหน่วยงาน',
            'attribute' => 'name_th',
            ],            
            [
                'label' => 'ชื่อ-นามสกุล ผู้ประสานงาน',
                'value' => $model->contact_name." ".$model->contact_surname,
            ],
            [
            'label' => 'เบอร์โทรศัพท์',
            'attribute' => 'contact_mobile',
            ], 
            [
            'label' => 'อีเมล',
            'attribute' => 'contact_email',
            ],
            [
            'label' => 'จังหวัด',
            'value' => $model->provinceId->title,
            ],
            [
            'label' => 'เขต/อำเภอ',
            //    'value' => '',
            'value' => isset($model->districtName)?$model->districtName:"- ไม่มีข้อมูล -"
            ],
            [
            'label' => 'เเขวง/ตำบล',
             'value' => isset($model->subDistrict->title)?$model->subDistrict->title:"- ไม่มีข้อมูล -",
            ],
            [
            'label' => 'รหัสไปรษณีย์',
            'attribute' => 'zipcode',
            ],
            'created_date',
            [
            		'label' => 'ผู้บันทึก',
            		'value' => $model->userCreated->username
        	],
            'updated_date',
            [
            		'label' => 'ผู้แก้ไข',
            		'value' =>$model->userUpdated->username
        	],
        ],
    ]) ?>
</div>
