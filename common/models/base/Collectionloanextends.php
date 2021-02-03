<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use inlislite\gii\behaviors\TerminalBehavior;

/**
 * This is the base-model class for table "collectionloanextends".
 *
 * @property integer $id
 * @property string $CollectionLoan_id
 * @property double $CollectionLoanItem_id
 * @property double $Collection_id
 * @property double $Member_id
 * @property string $DateExtend
 * @property string $DueDateExtend
 * @property integer $CreateBy
 * @property string $CreateDate
 * @property string $CreateTerminal
 * @property integer $UpdateBy
 * @property string $UpdateDate
 * @property string $UpdateTerminal
 *
 * @property \common\models\Collections $collection
 * @property \common\models\Collectionloans $collectionLoan
 * @property \common\models\Collectionloanitems $collectionLoanItem
 * @property \common\models\Users $createBy
 * @property \common\models\Members $member
 * @property \common\models\Users $updateBy
 */
class Collectionloanextends extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collectionloanextends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CollectionLoan_id', 'CollectionLoanItem_id', 'Collection_id', 'Member_id', 'DateExtend', 'DueDateExtend'], 'required'],
            [['CollectionLoanItem_id', 'Collection_id', 'Member_id'], 'number'],
            [['DateExtend', 'DueDateExtend', 'CreateDate', 'UpdateDate'], 'safe'],
            [['CreateBy', 'UpdateBy'], 'integer'],
            [['CollectionLoan_id'], 'string', 'max' => 255],
            [['CreateTerminal', 'UpdateTerminal'], 'string', 'max' => 100],
            [['Collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collections::className(), 'targetAttribute' => ['Collection_id' => 'ID']],
            [['CollectionLoan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collectionloans::className(), 'targetAttribute' => ['CollectionLoan_id' => 'ID']],
            [['CollectionLoanItem_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collectionloanitems::className(), 'targetAttribute' => ['CollectionLoanItem_id' => 'ID']],
            [['CreateBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['CreateBy' => 'ID']],
            [['Member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['Member_id' => 'ID']],
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
            'CollectionLoan_id' => Yii::t('app', 'Collection Loan ID'),
            'CollectionLoanItem_id' => Yii::t('app', 'Collection Loan Item ID'),
            'Collection_id' => Yii::t('app', 'Collection ID'),
            'Member_id' => Yii::t('app', 'Member ID'),
            'DateExtend' => Yii::t('app', 'Date Extend'),
            'DueDateExtend' => Yii::t('app', 'Due Date Extend'),
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
    public function getCollection()
    {
        return $this->hasOne(\common\models\Collections::className(), ['ID' => 'Collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollectionLoan()
    {
        return $this->hasOne(\common\models\Collectionloans::className(), ['ID' => 'CollectionLoan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollectionLoanItem()
    {
        return $this->hasOne(\common\models\Collectionloanitems::className(), ['ID' => 'CollectionLoanItem_id']);
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
    public function getMember()
    {
        return $this->hasOne(\common\models\Members::className(), ['ID' => 'Member_id']);
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
