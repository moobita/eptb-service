<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_lecturer".
 *
 * @property integer $id
 * @property string $name_th
 * @property string $surname_th
 * @property string $name_en
 * @property string $surname_en
 * @property string $mobile
 * @property string $email
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class MsLecturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_lecturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_th'], 'required','message' => 'โปรดระบุ ชื่อวิทยากร'],
            [['created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name_th', 'surname_th', 'name_en', 'surname_en', 'email'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name_th' => 'ชื่อ',
            'surname_th' => 'นามสกุล',
            'name_en' => 'ชื่อ(อังกฤษ)',
            'surname_en' => 'นามสกุล(อังกฤษ)',
            'mobile' => 'โทรศัพท์มือถือ',
            'email' => 'อีเมล',
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
    
    public function getFullname(){
        return $this->name_th." ".$this->surname_th;
    }
}
