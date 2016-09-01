<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trn_edu_testing_edu_level".
 *
 * @property integer $id
 * @property integer $trn_edu_testing_id
 * @property integer $edu_level_id
 * @property integer $edu_level_phase_id
 * @property integer $count_examiner
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property TrnEduTesting $trnEduTesting
 * @property MsEduLevel $eduLevel
 * @property MsEduLevelPhase $eduLevelPhase
 */
class TrnEduTestingEduLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trn_edu_testing_edu_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_edu_testing_id', 'edu_level_id', 'edu_level_phase_id', 'count_examiner'], 'required'],
            [['trn_edu_testing_id', 'edu_level_id', 'edu_level_phase_id', 'count_examiner', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_date', 'updated_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_edu_testing_id' => Yii::t('app', 'Trn Edu Testing ID'),
            'edu_level_id' => Yii::t('app', 'Edu Level ID'),
            'edu_level_phase_id' => Yii::t('app', 'Edu Level Phase ID'),
            'count_examiner' => Yii::t('app', 'จำนวน'),
            'status' => Yii::t('app', 'Status'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_date' => Yii::t('app', 'Created Date'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
    public function getEduLevel()
    {
        return $this->hasOne(MsEduLevel::className(), ['id' => 'edu_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEduLevelPhase()
    {
        return $this->hasOne(MsEduLevelPhase::className(), ['id' => 'edu_level_phase_id']);
    }
}
