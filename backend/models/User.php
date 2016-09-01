<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at','name_th','lastname_th','mobile'], 'required'],
            [['status', 'created_at', 'updated_at','mobile'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email','name_th','name_en','lastname_th','lastname_en'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'username' => 'ชื่อผู้ใช้งาน',
            'auth_key' => 'รหัสตรวจสอบ',
            'password_hash' => 'รหัสผ่าน',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'อีเมล',
            'status' => 'สถานะ',
            'created_at' => 'วันที่สร้าง',
            'updated_at' => 'วันที่แก้ไข',
        		
        	'name_th' => 'ชื่อ (ภาษาไทย)',
        	'name_en'=> 'ชื่อ (ภาษาอังกฤษ)',
        	'lastname_th' => 'นามสกุล (ภาษาไทย)',
        	'lastname_en' => 'นามสกุล (ภาษาอังกฤษ)',
        	'mobile' => 'เบอร์มือถือ',
        ];
    }
    
    public function getFullname(){
    	return $this->name_th." ".$this->lastname_th;
    }
    public function getFullname_en(){
    	return $this->name_en." ".$this->lastname_en;
    }
    
    
    
    
}
