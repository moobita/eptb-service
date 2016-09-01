<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trn_edu_testing_subjects".
 *
 * @property integer $id
 * @property integer $trn_edu_testing_id
 * @property integer $subjects_id
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property TrnEduTesting $trnEduTesting
 * @property MsSubjects $subjects
 */
class TrnEduTestingSubjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trn_edu_testing_subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_edu_testing_id', 'subjects_id', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['trn_edu_testing_id', 'subjects_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
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
            'subjects_id' => 'Subjects ID',
            'status' => 'สถานะ',
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
    public function getSubjects()
    {
        return $this->hasOne(MsSubjects::className(), ['id' => 'subjects_id']);
    }
    
}
