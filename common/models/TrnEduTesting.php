<?php

namespace common\models;

use Yii;
use common\models\TrnEduTestingEduLevel;
use common\models\TrnEduTestingSubjects;
use common\models\TrnEduTestingLecturer;
use common\models\TrnEduTestingTestSet;
/**
 * This is the model class for table "trn_edu_testing".
 *
 * @property integer $id
 * @property integer $ins_id
 * @property string $test_start
 * @property string $test_end
 * @property integer $obj_id
 * @property integer $test_type_id
 * @property integer $count_examiner
 * @property integer $trn_edu_testing_edu_level_id
 * @property integer $trn_edu_testing_edu_level_phase_id
 * @property integer $trn_edu_testing_test_set_id
 * @property integer $trn_edu_testing_lecturer_id
 * @property string $contact_name
 * @property string $contact_surname
 * @property string $contact_mobile
 * @property string $contact_office_phone
 * @property string $contact_email
 * @property string $contact_note
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class TrnEduTesting extends \yii\db\ActiveRecord
{
	public $ms_subjects_id;
	public $tbl_edu;
	public $tbl_subject;
	public $tbl_lect;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trn_edu_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_id', 'obj_id', 'test_type_id', 'trn_edu_testing_edu_level_id','trn_edu_testing_edu_level_phase_id', 'trn_edu_testing_test_set_id', 'trn_edu_testing_lecturer_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['test_start'], 'required','message' => 'โปรดระบุ วันที่สอบ'],
            [['ins_id'], 'required','message' => 'โปรดระบุ หน่วยงาน'],
            [['obj_id'], 'required','message' => 'โปรดระบุ วัตถุประสงค์'],
            [['tbl_subject'], 'required','message' => 'โปรดเพิ่มข้อมูล วิชา ลงในตาราง'],
            [['tbl_edu'], 'required','message' => 'โปรดเพิ่มข้อมูล ระดับชั้นที่สอบ ลงในตาราง'],
            [['tbl_lect'], 'required','message' => 'โปรดเพิ่มข้อมูล วิทยากร ลงในตาราง'],
            [['test_start', 'test_end', 'created_date', 'updated_date'], 'safe'],
            [['contact_note'], 'string'],
            [['contact_name', 'contact_surname', 'contact_mobile', 'contact_office_phone', 'contact_email'], 'string', 'max' => 30],
        	//[['count_examiner'], 'integer', 'min' => 1, 'max' => 10000, 'message' => 'กรอกตัวเลข']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ins_id' => 'Ins ID',
            'test_start' => 'Test Start',
            'test_end' => 'Test End',
            'obj_id' => 'Obj ID',
            'test_type_id' => 'Test Type ID',
            'count_examiner' => 'Count Examiner',
            'trn_edu_testing_edu_level_id' => 'Trn Edu Testing Edu Level ID',
        	'trn_edu_testing_edu_level_phase_id' => 'Trn Edu Testing Edu Level Phase ID',
            'trn_edu_testing_test_set_id' => 'Trn Edu Testing Test Set ID',
            'trn_edu_testing_lecturer_id' => 'Trn Edu Testing Lecturer ID',
            'contact_name' => 'Contact Name',
            'contact_surname' => 'Contact Surname',
            'contact_mobile' => 'Contact Mobile',
            'contact_office_phone' => 'Contact Office Phone',
            'contact_email' => 'Contact Email',
            'contact_note' => 'Contact Note',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
            
                //Vm Field
            'subjects_id' => 'วิชา',
            'tbl_subject' => 'ตารางวิชา',
        ];
    }
    
    public function getInstitutionName(){
    	return $this-> hasOne(MsInstitution::className(),['id' => 'ins_id'] );
    }
    
    public function getTestTypeName(){
    	return $this-> hasOne(MsTestType::className(),['id' => 'test_type_id'] );
    }
    
    public function getObjectiveName(){
    	return $this-> hasOne(MsObjective::className(),['id' => 'obj_id'] );
    }
    
    public function getEduTestingTestSet(){
    	return $this-> hasOne(TrnEduTestingTestSet::className(),['trn_edu_testing_id' => 'id'] );
    }
    
    public function getUserName(){
    	return $this-> hasOne(User::className(),['id' => 'created_by'] );
    }
    
    public function getTotalExa() {
     	$model = TrnEduTestingEduLevel::find()
     	->where("trn_edu_testing_id	 = $this->id")
     	->All();
     	$count = 0;
     	foreach ($model as $item){
     		$count = $count + $item->count_examiner;
     	}
    	return $count;
    }
    
    public function getTrnSubjects()
    {
       return $this->hasMany(MsSubjects::className(), ['id' => 'subjects_id'])
       ->viaTable('trn_edu_testing_subjects', ['trn_edu_testing_id'=>'id'])
       ->viaTable('trn_edu_testing_subjects', ['trn_edu_testing_id'=>'id']);
    }
    
    public function getTrnLect()
    {
        return $this->hasMany(MsLecturer::className(), ['id' => 'lecturer_id'])
        ->viaTable('trn_edu_testing_lecturer', ['trn_edu_testing_id'=>'id']);
    }
    
    public function getTrnTestSet()
    {
        return $this->hasMany(MsTestSet::className(), ['id' => 'test_set_id'])
        ->viaTable('trn_edu_testing_test_set', ['trn_edu_testing_id'=>'id']);
    }
    
   
}
