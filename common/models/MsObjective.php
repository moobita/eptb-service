<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_objective".
 *
 * @property integer $id
 * @property string $name_th
 * @property string $name_en
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class MsObjective extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_objective';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_th', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name_th', 'name_en'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name_th' => 'วัตถุประสงค์ในการสอบ(ไทย)',
            'name_en' => 'วัตถุประสงค์ในการสอบ(อังกฤษ)',
            'status' => 'สถานะ',
            'deleted' => 'สถานะการลบ',
            'created_date' => 'วันที่สร้าง',
            'created_by' => 'ผู้สร้าง',
            'updated_date' => 'วันที่แก้ไข',
            'updated_by' => 'ผู้แก้ไข',
        ];
    }
    
    public function getUserCreated(){
    	return $this-> hasOne(User::className(),['id' => 'created_by']);
    }
    
    public function getUserUpdated(){
    	return $this-> hasOne(User::className(),['id' => 'updated_by'] );
    }
}
