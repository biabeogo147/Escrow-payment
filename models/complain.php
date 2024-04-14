<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%complains}}".
 *
 * @property int $complain_id
 * @property int|null $user_id
 * @property int $complain_data
 * @property string $complain_details
 * @property int|null $create_user_id
 * @property int|null $update_user_id
 * @property int|null $update_time
 * @property int|null $create_time
 *
 * @property User $user
 */
class complain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%complains}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'complain_data', 'create_user_id', 'update_user_id', 'update_time', 'create_time'], 'integer'],
            [['complain_data', 'complain_details'], 'required'],
            [['complain_details'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'complain_id' => 'Complain ID',
            'user_id' => 'User ID',
            'complain_data' => 'Complain Data',
            'complain_details' => 'Complain Details',
            'create_user_id' => 'Create User ID',
            'update_user_id' => 'Update User ID',
            'update_time' => 'Update Time',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\app\models\query\UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['user_id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\complainQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\complainQuery(get_called_class());
    }
}
