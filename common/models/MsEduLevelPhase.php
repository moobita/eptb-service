<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_edu_level_phase".
 *
 * @property integer $id
 * @property integer $edu_level_id
 * @property string $name_th
 * @property string $name_en
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class MsEduLevelPhase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_edu_level_phase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_level_id', 'name_th', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['edu_level_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name_th', 'name_en'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'edu_level_id' => 'ระดับชั้น',
            'name_th' => 'ช่วงชั้น(ไทย)',
            'name_en' => 'ช่วงชั้น(อังกฤษ)',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getEduLevelName(){
    	return $this-> hasOne(MsEduLevel::className(),['id' => 'edu_level_id'] );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrnEduTestingEduLevels()
    {
    	return $this->hasMany(TrnEduTestingEduLevel::className(), ['edu_level_phase_id' => 'id']);
    }
    
    public function getEduLevels()
    {
    	return $this->hasOne(MsEduLevel::className(), ['id' => 'edu_level_id']);
    }
    
    public function getUserCreated(){
    	return $this-> hasOne(User::className(),['id' => 'created_by'] );
    }
    
    public function getUserUpdated(){
    	return $this-> hasOne(User::className(),['id' => 'updated_by'] );
    }
    
}
