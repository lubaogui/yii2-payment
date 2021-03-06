<?php
namespace lubaogui\payment\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use lubaogui\account\models\Trans;

/**
 * Payable model
 */
class Payable extends ActiveRecord
{
    const PAY_STATUS_WAITPAY = 1;
    const PAY_STATUS_PAYING = 2;
    const PAY_STATUS_FINISHED = 3;

    const PAY_METHOD_DIRECTPAY = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payable}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @brief 获取该支付记录对应的账户
     *
     * @return  public function 
     * @retval   
     * @see 
     * @note 
     * @author 吕宝贵
     * @date 2015/12/22 10:50:25
    **/
    public function getUserAccount() {
        return $this->hasOne(UserAccount::className(), ['uid'=>'receive_uid']);
    }

    /**
     * @brief 获取对应的trans记录
     *
     * @return  public function 
     * @retval   
     * @see 
     * @note 
     * @author 吕宝贵
     * @date 2015/12/22 10:55:02
    **/
    public function getTrans() {
        return $this->hasOne(Trans::className(), ['id'=>'trans_id']);
    }

    /**
     * @brief 获取账号关联的银行卡
     *
     * @return  public function 
     * @retval   
     * @see 
     * @note 
     * @author 吕宝贵
     * @date 2016/01/07 10:38:46
    **/
    public function getReceiverBankAccount() {
        return $this->hasOne(UserBankCard::className(), ['uid'=>'receive_uid']);
    }

    /**
     * @brief 付款给用户成功之后的操作 
     *
     * @return  public function 
     * @retval   
     * @see 
     * @note 
     * @author 吕宝贵
     * @date 2016/02/18 20:49:50
    **/
    public function payFinished($callback = null) {
        return true;
    }

}
