<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "vw_akuisisi_raw_log_status".
 *
 * @property integer $ID
 * @property integer $WorksheetID
 * @property string $WorksheetName
 * @property string $Judul
 * @property string $AnakJudul
 * @property string $Pengarang
 * @property string $PengarangTambahan
 * @property string $BadanKoperasi
 * @property string $Penerbit
 * @property string $TempatTerbit
 * @property string $TahunTerbit
 * @property string $Edisi
 * @property string $NoKlas
 * @property string $DeskripsiFisik
 * @property string $ISBN
 * @property string $Catatan
 * @property string $Skala
 * @property string $Sumber
 * @property string $KeteranganSumber
 * @property string $Currency
 * @property double $Harga
 * @property integer $AkuisisiLogID
 * @property string $ReportedBy
 * @property string $ReportedDate
 * @property string $LoggedDate
 * @property string $Status
 * @property string $Media
 * @property string $Penempatan
 * @property double $Eksemplar
 * @property string $Frekuensi
 */
class VwAkuisisiRawLogStatus extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_akuisisi_raw_log_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'WorksheetID', 'ReportedBy', 'ReportedDate', 'LoggedDate'], 'required'],
            [['ID', 'WorksheetID', 'AkuisisiLogID'], 'integer'],
            [['Harga', 'Eksemplar'], 'number'],
            [['ReportedDate', 'LoggedDate'], 'safe'],
            [['WorksheetName', 'TahunTerbit', 'Edisi', 'NoKlas', 'ISBN', 'Sumber', 'Currency', 'ReportedBy', 'Status', 'Media', 'Penempatan', 'Frekuensi'], 'string', 'max' => 50],
            [['Judul', 'AnakJudul', 'Catatan'], 'string', 'max' => 1000],
            [['Pengarang', 'PengarangTambahan', 'BadanKoperasi', 'Penerbit', 'TempatTerbit', 'DeskripsiFisik', 'Skala', 'KeteranganSumber'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'WorksheetID' => Yii::t('app', 'Worksheet ID'),
            'WorksheetName' => Yii::t('app', 'Worksheet Name'),
            'Judul' => Yii::t('app', 'Judul'),
            'AnakJudul' => Yii::t('app', 'Anak Judul'),
            'Pengarang' => Yii::t('app', 'Pengarang'),
            'PengarangTambahan' => Yii::t('app', 'Pengarang Tambahan'),
            'BadanKoperasi' => Yii::t('app', 'Badan Koperasi'),
            'Penerbit' => Yii::t('app', 'Penerbit'),
            'TempatTerbit' => Yii::t('app', 'Tempat Terbit'),
            'TahunTerbit' => Yii::t('app', 'Tahun Terbit'),
            'Edisi' => Yii::t('app', 'Edisi'),
            'NoKlas' => Yii::t('app', 'No Klas'),
            'DeskripsiFisik' => Yii::t('app', 'Deskripsi Fisik'),
            'ISBN' => Yii::t('app', 'Isbn'),
            'Catatan' => Yii::t('app', 'Catatan'),
            'Skala' => Yii::t('app', 'Skala'),
            'Sumber' => Yii::t('app', 'Sumber'),
            'KeteranganSumber' => Yii::t('app', 'Keterangan Sumber'),
            'Currency' => Yii::t('app', 'Currency'),
            'Harga' => Yii::t('app', 'Harga'),
            'AkuisisiLogID' => Yii::t('app', 'Akuisisi Log ID'),
            'ReportedBy' => Yii::t('app', 'Reported By'),
            'ReportedDate' => Yii::t('app', 'Reported Date'),
            'LoggedDate' => Yii::t('app', 'Logged Date'),
            'Status' => Yii::t('app', 'Status'),
            'Media' => Yii::t('app', 'Media'),
            'Penempatan' => Yii::t('app', 'Penempatan'),
            'Eksemplar' => Yii::t('app', 'Eksemplar'),
            'Frekuensi' => Yii::t('app', 'Frekuensi'),
        ];
    }


    
}
