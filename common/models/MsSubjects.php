<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_subjects".
 *
 * @property integer $id
 * @property string $name_code
 * @property string $name_th
 * @property string $name_en
 * @property integer $test_type_id
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class MsSubjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'deleted', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['test_type_id','status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['test_type_id'], 'required','message' => 'โปรดระบุ ประเภทวิชา'],
            [['name_th'], 'required','message' => 'โปรดระบุ ชื่อวิชา'],
            [['name_code', 'name_th', 'name_en'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name_code' => 'รหัสวิชา',
            'name_th' => 'ชื่อวิชา *',
            'name_en' => 'ชื่อวิชา(อังกฤษ)',
        	'test_type_id' => 'ประเภทแบบทดสอบ *',
            'status' => 'สถานะ',
            'deleted' => 'Deleted',
            'created_date' => 'วันที่สร้าง',
            'created_by' => 'ผู้สร้าง',
            'updated_date' => 'วันที่แก้ไข',
            'updated_by' => 'ผู้แก้ไข',
        ];
    }
    
    public function getUserCreated(){
    	return $this-> hasOne(User::className(),['id' => 'created_by'] );
    }
    
    public function getUserUpdated(){
    	return $this-> hasOne(User::className(),['id' => 'updated_by'] );
    }
    
    public function getTestType()
    {
    	return $this->hasOne(MsTestType::className(), ['id' => 'test_type_id']);
    	 
    	// 		return $this->hasMany(Tags::className(), ['ID' => 'TagsID'])
    	// 			    ->viaTable(Articlestags::tableName(), ['ArticlesID' => 'ID']);
    }
    
    public function getTest()
    {
        return "test";
    
        // 		return $this->hasMany(Tags::className(), ['ID' => 'TagsID'])
        // 			    ->viaTable(Articlestags::tableName(), ['ArticlesID' => 'ID']);
    }
    
}
