<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ms_province".
 *
 * @property integer $id
 * @property string $province_code
 * @property string $title
 * @property integer $geo_id
 */
class MsProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ms_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_code', 'title'], 'required'],
            [['id', 'geo_id'], 'integer'],
            [['province_code'], 'string', 'max' => 2],
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
            'province_code' => 'Province Code',
            'title' => 'Title',
            'geo_id' => 'Geo ID',
        ];
    }
}
