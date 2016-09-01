<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trn_edu_testing_test_set".
 *
 * @property integer $id
 * @property integer $trn_edu_testing_id
 * @property integer $test_set_id
 * @property integer $num
 * @property double $mean
 * @property double $sd
 * @property double $mn
 * @property double $max
 * @property double $kr20
 * @property double $varriance
 * @property double $range
 * @property integer $reli
 * @property integer $sem
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property TrnEduTesting $trnEduTesting
 * @property MsTestSet $testSet
 */
class TrnEduTestingTestSet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trn_edu_testing_test_set';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_edu_testing_id', 'test_set_id', 'updated_date', 'updated_by'], 'required'],
            [['trn_edu_testing_id', 'test_set_id', 'num', 'reli', 'sem', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['mean', 'sd', 'mn', 'max', 'kr20', 'varriance', 'range'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['trn_edu_testing_id'], 'exist', 'skipOnError' => true, 'targetClass' => TrnEduTesting::className(), 'targetAttribute' => ['trn_edu_testing_id' => 'id']],
            [['test_set_id'], 'exist', 'skipOnError' => true, 'targetClass' => MsTestSet::className(), 'targetAttribute' => ['test_set_id' => 'id']],
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
            'test_set_id' => 'Test Set ID',
            'num' => 'Num',
            'mean' => 'Mean',
            'sd' => 'Sd',
            'mn' => 'Mn',
            'max' => 'Max',
            'kr20' => 'Kr20',
            'varriance' => 'Varriance',
            'range' => 'Range',
            'reli' => 'Reli',
            'sem' => 'Sem',
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
    public function getTestSet()
    {
        return $this->hasOne(MsTestSet::className(), ['id' => 'test_set_id']);
    }
}
