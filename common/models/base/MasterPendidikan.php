<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use inlislite\gii\behaviors\TerminalBehavior;

/**
 * This is the base-model class for table "master_pendidikan".
 *
 * @property integer $id
 * @property string $Nama
 * @property integer $CreateBy
 * @property string $CreateDate
 * @property string $CreateTerminal
 * @property integer $UpdateBy
 * @property string $UpdateDate
 * @property string $UpdateTerminal
 * @property string $KIILastUploadDate
 *
 * @property \common\models\Users $createBy
 * @property \common\models\Users $updateBy
 * @property \common\models\Memberguesses[] $memberguesses
 * @property \common\models\Members[] $members
 */
class MasterPendidikan extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_pendidikan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nama'], 'required'],
            [['CreateBy', 'UpdateBy'], 'integer'],
            [['CreateDate', 'UpdateDate', 'KIILastUploadDate'], 'safe'],
            [['Nama'], 'string', 'max' => 50],
            [['CreateTerminal', 'UpdateTerminal'], 'string', 'max' => 100],
            [['CreateBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['CreateBy' => 'ID']],
            [['UpdateBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['UpdateBy' => 'ID']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Nama' => Yii::t('app', 'Nama'),
            'CreateBy' => Yii::t('app', 'Create By'),
            'CreateDate' => Yii::t('app', 'Create Date'),
            'CreateTerminal' => Yii::t('app', 'Create Terminal'),
            'UpdateBy' => Yii::t('app', 'Update By'),
            'UpdateDate' => Yii::t('app', 'Update Date'),
            'UpdateTerminal' => Yii::t('app', 'Update Terminal'),
            'KIILastUploadDate' => Yii::t('app', 'Kiilast Upload Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(\common\models\Users::className(), ['ID' => 'CreateBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdateBy()
    {
        return $this->hasOne(\common\models\Users::className(), ['ID' => 'UpdateBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberguesses()
    {
        return $this->hasMany(\common\models\Memberguesses::className(), ['PendidikanTerakhir_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(\common\models\Members::className(), ['EducationLevel_id' => 'id']);
    }


/**
     * @inheritdoc
     * @return type array
     */ 
    public function behaviors()
    {
        return [
        \common\widgets\nhkey\ActiveRecordHistoryBehavior::className(),
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'CreateDate',
                'updatedAtAttribute' => 'UpdateDate',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'CreateBy',
                'updatedByAttribute' => 'UpdateBy',
            ],
            [
                'class' => TerminalBehavior::className(),
                'createdTerminalAttribute' => 'CreateTerminal',
                'updatedTerminalAttribute' => 'UpdateTerminal',
                'value' => \Yii::$app->request->userIP,
            ],
        ];
    }


    
}
