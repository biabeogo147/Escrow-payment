<?php

namespace app\controllers;

use app\models\NlCheckout;
use app\models\NlPayout;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm;
use app\models\ResendVerificationEmail;
use app\models\VerifyEmailForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\data\ActiveDataProvider;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\RequestPayment;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'blank';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    //    public function actionLogin()
//    {
//        $this->layout = 'blank';
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        $model->password = '';
//        return $this->render('login', [
//            'model' => $model,
//        ]);
//    }
//
//    public function actionProcess()
//    {
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//
//            return $this->goBack();
//        } else {
//            echo "Đăng nhập thất bại";
//        }
//    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $this->layout = 'blank';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionVerifyemail($token)
    {
        $this->layout = 'blank';
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->render('account', ['model' => $user,]);
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');

        return $this->render('account', ['model' => $user,]);
    }

    public function actionAccount()
    {
        $this->layout = 'blank';

        $request = new User();
        $model = User::findOne(Yii::$app->user->identity->user_id);

        if ($request->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->post('User');
            $model->fullname = $request['fullname'];
            $model->mobile = $request['mobile'];
            $model->address = $request['address'];
            $model->cccd_number = $request['cccd_number'];
            $model->cccd_issue_date = $request['cccd_issue_date'];
            $model->cccd_issue_name = $request['cccd_issue_name'];
            $model->update_time = time();

            if ($model->email != $request['email']) {
                $model->email_confirm_date = null;
            }

            if ($model->email_confirm_date == null) {
                $resendMail = new ResendVerificationEmail();
                $model->email = $request['email'];
                $resendMail->sendEmail($model);
            }

            $model->save();
        }
        return $this->render('account', ['model' => $model,]);
    }

    public function actionMerchantorder()
    {
        $this->layout = 'blank';
        $dataProvider = new ActiveDataProvider([
            'query' => RequestPayment::find()
                ->andWhere(['merchant' => Yii::$app->user->identity->user_id]),
        ]);

        return $this->render('merchantorder', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreatemerchantorder()
    {
        $this->layout = 'blank';
        $model = new RequestPayment();
        if ($model->load(Yii::$app->request->post())) {
            $model->merchant = Yii::$app->user->identity->user_id;
            $model->created_time = time();
            $model->save();
            return $this->redirect(['merchantorder']);
        }

        return $this->render('createmerchantorder', [
            'model' => $model,
        ]);
    }

    public function actionCustomerorder()
    {
        $this->layout = 'blank';
        $dataProvider = new ActiveDataProvider([
            'query' => RequestPayment::find()
                ->andWhere(['customer' => Yii::$app->user->identity->user_id]),
        ]);

        return $this->render('customerorder', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionVieworder($id)
    {
        $this->layout = 'blank';
        $model = RequestPayment::findOne(['id' => $id]);

        return $this->render('vieworder', [
            'model' => $model,
        ]);
    }

    public function actionViewpayment($id)
    {
        $this->layout = 'blank';
        $model = RequestPayment::findOne(['id' => $id]);
        $payout = NlPayout::findOne(['reference_code' => $model->paid_status]);
        $payoutTransaction = $payout->buildGetPayoutTransaction();
        foreach ($payoutTransaction as $key => $value) {
            if (is_object($value)) {
                foreach ($value as $childKey => $childValue) {
                    if ($childKey == "time_created") {
                        $childValue = date("d-m-Y H:i:s", $childValue);
                    }
                    echo $childKey . ": " . $childValue . "<br>";
                }
            } else
                echo $key . ": " . $value . "<br>";
        }
    }

    public function actionAcceptrequest($id)
    {
        $this->layout = 'blank';
        $model = RequestPayment::findOne(['id' => $id]);
        $model->accept_request = time();
        $model->save();
        return $this->redirect(['vieworder', 'id' => $id]);
    }

    public function actionPayforintermediaries($id)
    {
        $this->layout = 'blank';

        $payout = new NlPayout();
        if ($payout->load(Yii::$app->request->post())) {
            $model = RequestPayment::findOne(['id' => $id]);

            $customer = User::findOne(['user_id' => $model->customer]);
            $merchant = User::findOne(['user_id' => $model->merchant]);

            #merchant_id 52834 52814
            #merchant_password 8d6cddf344a312df84cd5dae3d12d291 2beefb9378837b38c6bb6bd26fa304ac
            $payout->user_email = $customer->email;
            $payout->receive_email = $merchant->email;
            $payout->amount = $model->price;
            $payout->reference_code = 'NL_' . time();

            $response = $payout->buildTranfer();
            //var_dump($response);
            //die;

            if ($response == 'E00') {
                $model->paid_status = $payout->reference_code;
                $payout->save();
                $model->save();
                //die;
                return $this->redirect(['vieworder', 'id' => $id]);
            } else {
                echo 'Không thể thực hiện';
                die;
            }
        }

        return $this->render('getmerchantpass', ['model' => $payout]);
    }

    public function actionProductdelivery($id)
    {
        $this->layout = 'blank';
        $model = RequestPayment::findOne(['id' => $id]);
        $model->product_delivery = time();
        $model->save();
        return $this->redirect(['vieworder', 'id' => $id]);
    }

    public function actionAcceptproduct($id)
    {
        $this->layout = 'blank';
        $model = RequestPayment::findOne(['id' => $id]);
        $model->accept_product = time();
        $model->save();
        #Gửi tín hiệu chuyển tiền cho người bán
        return $this->redirect(['vieworder', 'id' => $id]);
    }
}
