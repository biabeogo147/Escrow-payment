<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $mobile
 * @property string $address
 * @property string $fullname
 * @property int $cccd_number
 * @property int $cccd_issue_date
 * @property string $cccd_issue_name
 * @property int|null $email_confirm_date
 * @property int|null $mobile_confirm_date
 * @property string|null $other_details
 * @property int|null $update_time
 * @property int|null $created_time
 * @property string $authKey
 *
 * @property Complain[] $complains
 * @property Order[] $orders
 * @property Transaction[] $transactions
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $authKey;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password',], 'required'],
            [['mobile', 'cccd_number', 'cccd_issue_date', 'email_confirm_date', 'mobile_confirm_date', 'update_time', 'created_time'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['email', 'password', 'address', 'fullname', 'cccd_issue_name', 'other_details'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'fullname' => 'Fullname',
            'cccd_number' => 'Cccd Number',
            'cccd_issue_date' => 'Cccd Issue Date',
            'cccd_issue_name' => 'Cccd Issue Name',
            'email_confirm_date' => 'Email Confirm Date',
            'mobile_confirm_date' => 'Mobile Confirm Date',
            'other_details' => 'Other Details',
            'update_time' => 'Update Time',
            'created_time' => 'Created Time',
        ];
    }

    /**
     * Gets query for [[Complains]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\ComplainQuery
     */
    public function getComplains()
    {
        return $this->hasMany(Complain::class, ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\TransactionQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::class, ['user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\userQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\userQuery(get_called_class());
    }

    public static function findIdentity($user_id)
    {
        return static::findOne(['user_id' => $user_id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        if ($user = static::findOne(['username' => $username])) {
            // if (md5($password . $user->salt) == $user->password) {
            //     return $user;
            // }
            return $user;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function generateEmailVerificationToken()
    {
        $this->other_details = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public static function findByVerificationToken($token)
    {
        $user = User::find()->where(['other_details' => $token])->one();
        return $user;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
