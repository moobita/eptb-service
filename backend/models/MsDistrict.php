<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ms_district".
 *
 * @property integer $id
 * @property string $district_code
 * @property string $title
 * @property integer $amphur_id
 * @property integer $province_id
 * @property integer $geo_id
 */
class MsDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_code', 'title'], 'required'],
            [['id', 'amphur_id', 'province_id', 'geo_id'], 'integer'],
            [['district_code'], 'string', 'max' => 6],
            [['title'], 'string', 'max' => 150]
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
            'title' => 'Title',
            'amphur_id' => 'Amphur ID',
            'province_id' => 'Province ID',
            'geo_id' => 'Geo ID',
        ];
    }
}
