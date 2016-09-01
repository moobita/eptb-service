<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_test_set".
 *
 * @property integer $id
 * @property string $code_name
 * @property integer $subject_id
 * @property integer $test_type_id
 * @property integer $edu_level_id
 * @property integer $edu_level_phase_id
 * @property string $std_year
 * @property integer $c_choice
 * @property integer $c_print
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property MsSubjects $subject
 * @property MsEduLevelPhase $eduLevelPhase
 */
class MsTestSet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_test_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['subject_id', 'test_type_id', 'edu_level_id', 'edu_level_phase_id', 'c_choice', 'c_print', 'c_min', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['test_type_id'], 'required','message' => 'โปรดระบุ ประเภทแบบทดสอบ'],
            [['code_name'], 'required','message' => 'โปรดระบุ ชื่อแบบทดสอบ'],
            [['subject_id'], 'required','message' => 'โปรดระบุ วิชา'],
            [['std_year'], 'required','message' => 'โปรดระบุ มาตรฐานปี'],
            [['c_choice'], 'required','message' => 'โปรดระบุ ข้อ'],
            [['c_min'], 'required','message' => 'โปรดระบุ นาที'],
            [['c_print'], 'required','message' => 'โปรดระบุ จำนวนที่พิมพ์'],
            [['code_name'], 'string', 'max' => 30],
            [['std_year'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code_name' => 'Code Name',
            'subject_id' => 'Subject ID',
            'test_type_id' => 'Test Type ID',
            'edu_level_id' => 'Edu Level ID',
            'edu_level_phase_id' => 'Edu Level Phase ID',
            'std_year' => 'Std Year',
            'c_choice' => 'C Choice',
            'c_print' => 'C Print',
            'c_min' => 'C Minute',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(MsSubjects::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEduLevelPhase()
    {
        return $this->hasOne(MsEduLevelPhase::className(), ['id' => 'edu_level_phase_id']);
    }
    
    //เดียวจะตัดออก
    public function getEduLevelName(){
        return $this-> hasOne(MsEduLevel::className(),['id' => 'edu_level_id'] );
    }
    public function getTestTypeName(){
        return $this-> hasOne(MsTestType::className(),['id' => 'test_type_id'] );
    }
}
