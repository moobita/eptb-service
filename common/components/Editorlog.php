<?php
namespace common\components;

use Yii;

class Editorlog
{

    public static function create($model,$status = 1,$deleted = 0)
    {
        $model->status = 1;
        $model->deleted = 0;
        $model->created_by = Yii::$app->user->identity->id;
        $model->created_date = date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;
        $model->updated_date = date('Y-m-d H:i:s');
        return $model;
    }
    
    public static function convertToDateThai($dateEng)
    {
        // ex. 2016-01-1 convert to 01/01/2559
        $result_date = explode("-", $dateEng);
        $new_date = ($result_date[2])."/".($result_date[1])."/".($result_date[0]+543);
       // $date = Yii::$app->formatter->asDate($new_date, 'php:Y-m-d');
        return $new_date;
    }
    
    public static function convertToDateInter($dateThai)
    {
         // ex. 01/01/2559 convert to 2016-01-1
        $result_date = explode("/", $dateThai);
        $new_date = ($result_date[2]-543) . "-" . ($result_date[1]) . "-" . ($result_date[0]);
        $date = Yii::$app->formatter->asDate($new_date, 'php:Y-m-d');
        return $date;
    }
    

    public static function update($model,$status = 1,$deleted = 0)
    {
        $model->status = $status;
        $model->deleted = $deleted;
        $model->updated_by = Yii::$app->user->identity->id;
        $model->updated_date = date('Y-m-d H:i:s');
        return $model;
    }
    
    public static function convertThaiNumber($num){
        return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),
            array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),
            $num);
    }
    
    public static function getRoleName($id){
        switch ($id)
        {
            case 10:
                $name = "ADMIN";
                break;
            case 20:
                $name = "BOARD";
                break;
        }
        return $name;
    }
    
    public static function getScoreLevel($score){
        $score_result = round($score);
        switch ($score_result)
        {
            case 1:
                $title = "ต้องปรับปรุงเร่งด่วน";
                break;
            case 2:
                $title = "ต้องปรับปรุง";
                break;
            case 3:
                $title = "พอใช้";
                break;
            case 4:
                $title = "ดี";
                break;
            case 5:
                $title = "ดีมาก";
                break;
            case $score_result>5:
                $title = "ดีมาก";
                break;
            
                default:$title = "";
        }
        return $title;
    }
    
    public static function getExcel($filename=nul,$text_content=null){
        $this->layout = 'excel';
        $text_content = $text_content;
        return  $this->render('excel_01',[
            'filename'=> $filename,
            'text_content'=> $text_content,
        ]);
    
    }
}