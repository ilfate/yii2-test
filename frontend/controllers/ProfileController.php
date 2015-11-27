<?php
namespace frontend\controllers;

use common\models\Avatar;
use common\models\User;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * Profile controller
 */
class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'edit'],
                'rules' => [
                    [
                        'actions' => ['index', 'edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
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

    public function actionIndex()
    {
        $user = User::findIdentity(Yii::$app->user->identity->getId());
        $avatar = $user->avatar;
        if (!$avatar) {
            $avatar = new Avatar();
        }
        return $this->render('index', [
            'avatar' => $avatar->getUrl(),
            'user' => $user,
        ]);
    }

    public function actionEdit()
    {
        // TODO: CSRF protection
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!Yii::$app->request->isAjax) {
            return [
                'error' => 'Wrong request',
                'code' => 404
            ];
        }
        $data = Yii::$app->request->post();
        $user = User::findIdentity(Yii::$app->user->identity->getId());
        try {
            $user->updateField($data['type'], $data['value']);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }

        return [
            'code' => 200,
        ];
    }
}
