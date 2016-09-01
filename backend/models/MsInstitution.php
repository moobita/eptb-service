<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ms_institution".
 *
 * @property integer $id
 * @property string $name_th
 * @property string $name_en
 * @property integer $type_id
 * @property integer $district_id
 * @property string $contact_name
 * @property string $contact_surname
 * @property string $contact_mobile
 * @property string $contact_office_phone
 * @property string $contact_email
 * @property string $note
 * @property integer $status
 * @property integer $deleted
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class MsInstitution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_institution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_th', 'type_id', 'district_id', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['type_id', 'district_id', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['note'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['name_th', 'name_en'], 'string', 'max' => 100],
            [['contact_name', 'contact_surname', 'contact_office_phone', 'contact_email'], 'string', 'max' => 50],
            [['contact_mobile'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_th' => 'Name Th',
            'name_en' => 'Name En',
            'type_id' => 'Type ID',
            'district_id' => 'District ID',
            'contact_name' => 'Contact Name',
            'contact_surname' => 'Contact Surname',
            'contact_mobile' => 'Contact Mobile',
            'contact_office_phone' => 'Contact Office Phone',
            'contact_email' => 'Contact Email',
            'note' => 'Note',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }
}
