<?php

namespace backend\models;

use Yii;
use common\models\MsTestSet;

/**
 * This is the model class for table "trn_edu_testing_test_set".
 *
 * @property integer $id
 * @property integer $trn_edu_testing_id
 * @property integer $test_set_id
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
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
            [['trn_edu_testing_id', 'test_set_id', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['trn_edu_testing_id', 'test_set_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
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
            'test_set_id' => 'Test Set ID',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getTestSetName(){
    	return $this-> hasOne(MsTestSet::className(),['id' => 'test_set_id'] );
    }
}
