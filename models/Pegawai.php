<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property string $nip
 * @property string $nama
 * @property string $gender
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property int $idjabatan
 * @property int $iddivisi
 * @property string|null $alamat
 * @property string $email
 * @property string|null $foto
 *
 * @property Gaji[] $gajis
 * @property Divisi $iddivisi0
 * @property Jabatan $idjabatan0
 * @property Pelatihan[] $pelatihans
 */
class Pegawai extends \yii\db\ActiveRecord
{
    //tambahkan variabel baru untuk menyimpan file foto
    public $fotoFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */



    public function rules()
    {
        return [
            [['nip', 'nama', 'gender', 'tempat_lahir', 'tanggal_lahir', 'idjabatan', 'iddivisi', 'email'], 'required'],
            [['gender', 'alamat'], 'string'],
            [['tanggal_lahir'], 'safe'],
            [['idjabatan', 'iddivisi'], 'integer'],
            [['nip'], 'string', 'max' => 7],
            [['nama', 'tempat_lahir', 'email', 'foto'], 'string', 'max' => 45],
            [['nip'], 'unique'],
            [['email'], 'unique'],
            [['iddivisi'], 'exist', 'skipOnError' => true, 'targetClass' => Divisi::className(), 'targetAttribute' => ['iddivisi' => 'id']],
            [['idjabatan'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['idjabatan' => 'id']],
            
            //tambahan rule upload file
            [['fotoFile'], 'file',
                'extensions' => 'jpg,jpeg,png,gif',
                'maxSize'=>'256000', // max 250 KB
                'skipOnEmpty'=>true, //boleh kosong
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'gender' => 'Gender',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'idjabatan' => 'Jabatan',
            'iddivisi' => 'Divisi',
            'alamat' => 'Alamat',
            'email' => 'Email',
            'foto' => 'Foto',
            'fotoFile' => 'File Foto',
        ];
    }

    /**
     * Gets query for [[Gajis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGajis()
    {
        return $this->hasMany(Gaji::className(), ['pegawai_id' => 'id']);
    }

    /**
     * Gets query for [[Iddivisi0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIddivisi0()
    {
        return $this->hasOne(Divisi::className(), ['id' => 'iddivisi']);
    }

    /**
     * Gets query for [[Idjabatan0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdjabatan0()
    {
        return $this->hasOne(Jabatan::className(), ['id' => 'idjabatan']);
    }

    /**
     * Gets query for [[Pelatihans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPelatihans()
    {
        return $this->hasMany(Pelatihan::className(), ['pegawai_id' => 'id']);
    }

}
