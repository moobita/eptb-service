<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ms_amphur".
 *
 * @property integer $id
 * @property string $amphur_code
 * @property string $title
 * @property integer $geo_id
 * @property integer $province_id
 */
class MsAmphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_amphur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'amphur_code', 'title'], 'required'],
            [['id', 'geo_id', 'province_id'], 'integer'],
            [['amphur_code'], 'string', 'max' => 4],
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
            'amphur_code' => 'Amphur Code',
            'title' => 'Title',
            'geo_id' => 'Geo ID',
            'province_id' => 'Province ID',
        ];
    }
}
