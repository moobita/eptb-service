<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ms_zipcode".
 *
 * @property integer $id
 * @property string $district_code
 * @property string $province_id
 * @property string $amphur_id
 * @property string $district_id
 * @property string $zipcode
 */
class MsZipcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_zipcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_code', 'province_id', 'amphur_id', 'district_id', 'zipcode'], 'required'],
            [['id'], 'integer'],
            [['district_code', 'province_id', 'amphur_id', 'district_id'], 'string', 'max' => 100],
            [['zipcode'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_code' => 'District Code',
            'province_id' => 'Province ID',
            'amphur_id' => 'Amphur ID',
            'district_id' => 'District ID',
            'zipcode' => 'Zipcode',
        ];
    }
}
