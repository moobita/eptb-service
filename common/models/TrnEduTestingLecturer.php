<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trn_edu_testing_lecturer".
 *
 * @property integer $id
 * @property integer $trn_edu_testing_id
 * @property integer $lecturer_id
 * @property integer $lecturer_main
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property TrnEduTesting $trnEduTesting
 * @property MsLecturer $lecturer
 * @property User $createdBy
 * @property User $updatedBy
 */
class TrnEduTestingLecturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trn_edu_testing_lecturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_edu_testing_id', 'lecturer_id', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['trn_edu_testing_id', 'lecturer_id', 'lecturer_main', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trn_edu_testing_id' => 'Trn Edu Testing ID',
            'lecturer_id' => 'Lecturer ID',
            'lecturer_main' => 'Lecturer Main',
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
    public function getTrnEduTesting()
    {
        return $this->hasOne(TrnEduTesting::className(), ['id' => 'trn_edu_testing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLecturer()
    {
        return $this->hasOne(MsLecturer::className(), ['id' => 'lecturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
