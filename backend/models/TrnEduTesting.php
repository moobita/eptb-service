<?php

namespace app\models;

use Yii;
use common\models\MsInstitution;

/**
 * This is the model class for table "trn_edu_testing".
 *
 * @property integer $id
 * @property integer $ins_id
 * @property string $test_start
 * @property string $test_end
 * @property integer $obj_id
 * @property integer $test_type_id
 * @property integer $count_examiner
 * @property integer $trn_edu_testing_edu_level_id
 * @property integer $trn_edu_testing_test_set_id
 * @property integer $trn_edu_testing_lecturer_id
 * @property string $contact_name
 * @property string $contact_surname
 * @property string $contact_mobile
 * @property string $contact_office_phone
 * @property string $contact_email
 * @property string $contact_note
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class TrnEduTesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trn_edu_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_id', 'obj_id', 'test_type_id', 'count_examiner', 'trn_edu_testing_edu_level_id', 'trn_edu_testing_test_set_id', 'trn_edu_testing_lecturer_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['test_start'], 'required'],
            [['test_start', 'test_end', 'created_date', 'updated_date'], 'safe'],
            [['contact_note'], 'string'],
            [['contact_name', 'contact_surname', 'contact_mobile', 'contact_office_phone', 'contact_email'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ins_id' => 'Ins ID',
            'test_start' => 'Test Start',
            'test_end' => 'Test End',
            'obj_id' => 'Obj ID',
            'test_type_id' => 'Test Type ID',
            'count_examiner' => 'Count Examiner',
            'trn_edu_testing_edu_level_id' => 'Trn Edu Testing Edu Level ID',
            'trn_edu_testing_test_set_id' => 'Trn Edu Testing Test Set ID',
            'trn_edu_testing_lecturer_id' => 'Trn Edu Testing Lecturer ID',
            'contact_name' => 'Contact Name',
            'contact_surname' => 'Contact Surname',
            'contact_mobile' => 'Contact Mobile',
            'contact_office_phone' => 'Contact Office Phone',
            'contact_email' => 'Contact Email',
            'contact_note' => 'Contact Note',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
}
