<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_test_type".
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
class MsTestType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_test_type';
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
            [['name_th', 'name_en'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'name_th' => 'ประเภทแบบทดสอบ(ไทย)',
            'name_en' => 'ประเภทแบบทดสอบ(อังกฤษ)',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getUserCreated(){
    	return $this-> hasOne(User::className(),['id' => 'created_by'] );
    }
    
    public function getUserUpdated(){
    	return $this-> hasOne(User::className(),['id' => 'updated_by'] );
    }
    
}
