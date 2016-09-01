<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Editorlog;
use moonland\phpexcel\Excel;
        Excel::widget([
            'models' => $allModels,
            'mode' => 'export', //default value as 'export'
            'columns' => [
                'institutionName.name_th:text:ชื่อหน่วยงาน',
                'objectiveName.name_th:text:วัตถุประสงค์',
                ['attribute' => 'จำนวนคนสอบ',
                'value' => function ($model) {
                return $model->count_examiner;
                }
                ],
                ['attribute' => 'วันที่สอบ',
                'value' => function ($model) {
                return Editorlog::convertToDateThai($model->test_start);
                }
                ],
                ['attribute' => 'สถานะ',
                    'value' => function ($model) {
                    $statusName = "";
                    switch ($model->status){
                        case 0:
                            $statusName = "ยกเลิก";
                            break;
                        case 1:
                            $statusName = "รออนุมัติ";
                            break;
                        case 2:
                            (date('Y-m-d') == $model->test_start)?
                            $statusName = "รอบันทึกสถิติ":$statusName = "อนุมัติ";
                            break;
                        case 3:
                            $statusName = "เสร็จสิ้น";
                            break;
                    }
                    return $statusName;
                    }
                    ],
                    ['attribute' => 'วันที่เพิ่มข้อมูล',
                        'value' => function ($model) {
                        return Editorlog::convertToDateThai(date('Y-m-d', strtotime($model->created_date)));
                        }
                        ],
                'userName.username:text:ผู้ที่เพิ่มข้อมูล',
                
            ], //without header working, because the header will be get label from attribute label.
            //  'header' => ['column1' => 'Header Column 1'],
        ]);
?>