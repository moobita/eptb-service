<?php

namespace common\models;

use Yii;
use backend\models\MsProvince;
use backend\models\MsDistrict;

/**
 * This is the model class for table "ms_institution".
 *
 * @property integer $id
 * @property string $name_th
 * @property string $name_en
 * @property integer $type_id
 * @property integer $district_id
 * @property string $zipcode
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
 * @property integer $province_id
 */
class MsInstitution extends \yii\db\ActiveRecord
{
	
	public $imageFile;
	public $amphur_id;
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
            [['created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
        	[['type_id','province_id'], 'required','message' => 'โปรดระบุ จังหวัด'],
        	[['name_th'], 'required','message' => 'โปรดระบุ ชื่อหน่วยงาน'],            
            [['type_id', 'district_id','amphur_id', 'status', 'deleted', 'created_by', 'updated_by','province_id'], 'integer'],
            [['note'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
        	[['contact_name'], 'required','message' => 'โปรดระบุ ชื่อผู้ประสานงาน'],
        	[['contact_email'], 'required','message' => 'โปรดระบุ อีเมล'],
        	[['contact_mobile'], 'required','message' => 'โปรดระบุ เบอร์โทรศัพท์มือถือ'],
        	[['contact_surname'], 'required','message' => 'โปรดระบุ นามสกุล'],
        	[['contact_office_phone'], 'required','message' => 'โปรดระบุ บอร์โทรศัพท์ที่ทำงาน'],
        	[['name_th', 'name_en'], 'string', 'max' => 100],
            [['contact_name', 'contact_surname', 'contact_office_phone', 'contact_email'], 'string', 'max' => 50],
            [['zipcode'], 'string', 'max' => 5],
        	[['zipcode'], 'required','message' => 'โปรดระบุ รหัสไปรษณีย์'],
            [['contact_mobile'], 'string', 'max' => 30],
        	[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
   

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสหน่วยงาน',
            'name_th' => 'ชื่อหน่วยงาน (ภาษาไทย)',
            'name_en' => 'ชื่อหน่วยงาน (ภาษาอังกฤษ)',
            'type_id' => 'ประเภทหน่วยงาน',
            'amphur_id' => 'อำเภอ/เขต',
            'district_id' => 'ตำบล/แขวง',
            'zipcode' => 'รหัสไปรษณีย์',
            'contact_name' => 'ชื่อผู้ติดต่อ',
            'contact_surname' => 'นามสกุล',
            'contact_mobile' => 'เบอร์โทรศัพท์มือถือ',
            'contact_office_phone' => 'เบอร์โทรศัพท์ที่ทำงาน',
            'contact_email' => 'อีเมล',
            'note' => 'บันทึก',
            'status' => 'สถานะการใช้งาน',
            'deleted' => 'สถานะการลบ',
            'created_date' => 'วันที่สร้าง',
            'created_by' => 'ผู้สร้าง',
            'updated_date' => 'วันที่แก้ไข',
            'updated_by' => 'ผู้แก้ไข',
            'province_id' => 'จังหวัด',
            'amphur_id' => 'อำเภอ'
        ];
    }
    
    public function getUserCreated(){
    	return $this-> hasOne(User::className(),['id' => 'created_by'] );
    }
    
    public function getUserUpdated(){
    	return $this-> hasOne(User::className(),['id' => 'updated_by'] );
    }
    
    public function getTypeId(){
        return $this-> hasOne(MsInstitutionType::className(),['id' => 'type_id'] );
    }
    public function getProvinceId(){
        return $this-> hasOne(MsProvince::className(),['id' => 'province_id'] );
    }
    public function getDistrictName(){
       
        $model = MsDistrict::findOne($this->district_id);
        $amphur = MsAmphur::findOne($model->amphur_id);
        return $amphur->title;
       
    }
    public function getSubDistrict(){
        return $this-> hasOne(MsDistrict::className(),['id' => 'district_id'] );
    }
    
}
