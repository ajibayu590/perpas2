<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use inlislite\gii\behaviors\TerminalBehavior;

/**
 * This is the base-model class for table "auth_data".
 *
 * @property integer $ID
 * @property integer $Auth_Header_ID
 * @property string $Tag
 * @property string $Indicator1
 * @property string $Indicator2
 * @property string $Value
 * @property string $DataItem
 * @property integer $CreateBy
 * @property string $CreateDate
 * @property string $CreateTerminal
 * @property integer $UpdateBy
 * @property string $UpdateDate
 * @property string $UpdateTerminal
 *
 * @property \common\models\AuthHeader $authHeader
 * @property \common\models\Users $createBy
 * @property \common\models\Users $updateBy
 */
class AuthDataImport extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Auth_Header_ID', 'Tag'], 'required'],
            [['Auth_Header_ID', 'CreateBy', 'UpdateBy'], 'integer'],
            [['CreateDate', 'UpdateDate'], 'safe'],
            [['Tag'], 'string', 'max' => 3],
            [['Indicator1', 'Indicator2'], 'string', 'max' => 1],
            [['Value', 'DataItem'], 'string', 'max' => 700],
            [['CreateTerminal', 'UpdateTerminal'], 'string', 'max' => 100],
            [['Auth_Header_ID'], 'exist', 'skipOnError' => true, 'targetClass' => AuthHeader::className(), 'targetAttribute' => ['Auth_Header_ID' => 'ID']],
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
            'ID' => Yii::t('app', 'ID'),
            'Auth_Header_ID' => Yii::t('app', 'Auth  Header  ID'),
            'Tag' => Yii::t('app', 'Tag'),
            'Indicator1' => Yii::t('app', 'Indicator1'),
            'Indicator2' => Yii::t('app', 'Indicator2'),
            'Value' => Yii::t('app', 'Value'),
            'DataItem' => Yii::t('app', 'Data Item'),
            'CreateBy' => Yii::t('app', 'Create By'),
            'CreateDate' => Yii::t('app', 'Create Date'),
            'CreateTerminal' => Yii::t('app', 'Create Terminal'),
            'UpdateBy' => Yii::t('app', 'Update By'),
            'UpdateDate' => Yii::t('app', 'Update Date'),
            'UpdateTerminal' => Yii::t('app', 'Update Terminal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthHeader()
    {
        return $this->hasOne(\common\models\AuthHeader::className(), ['ID' => 'Auth_Header_ID']);
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
     * @inheritdoc
     * @return type array
     */ 
    public function behaviors()
    {
        $getIP = getHostByName(getHostName());
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
                'value' => $getIP,
                // 'value' => \Yii::$app->request->userIP,
            ],
        ];
    }


    
}
