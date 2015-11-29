<?php
namespace frontend\controllers;

use common\models\UploadForm;
use common\models\Avatar;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;

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
                'only' => ['index', 'edit', 'avatars', 'upload', 'delete-avatar'],
                'rules' => [
                    [
                        'actions' => ['index', 'edit', 'avatars', 'upload', 'delete-avatar'],
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

    public function actionAvatars()
    {
        $user = User::findIdentity(Yii::$app->user->identity->getId());
        $uploadModel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $result = [ 'code' => 500 ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            $uploadModel->file = UploadedFile::getInstanceByName('file');

            if ($uploadModel->file && $uploadModel->validate()) {

                $pathToFile = '/images/uploads/'
                    . Yii::$app->security->generateRandomString()
                    . '.' . $uploadModel->file->extension;

                if ($uploadModel->file->saveAs(Yii::getAlias('@webroot') . $pathToFile)) {
                    if ($user->newAvatar($pathToFile)) {
                        $result['code'] = 200;
                    }

                }
            } else {
                $result['errors'] = $uploadModel->getErrors();
            }
            return $result;
        }
        $avatars = $user->uploadedAvatars;
        return $this->render('avatars', [
            'avatars' => $avatars,
            'currentAvatar' => $user->avatar_id,
            'uploadModel' => $uploadModel,
        ]);
    }

    public function actionDeleteAvatar()
    {
        $user = User::findIdentity(Yii::$app->user->identity->getId());
        $data = Yii::$app->request->post();
        $avatar = Avatar::findById((int) $data['avatar_id']);
        if ($avatar) {
            if ($user->avatar_id == $avatar->id) {
                $user->avatar_id = null;
                $user->save();
            }
            $avatar->delete();
        }

        return $this->redirect('/profile/avatars');
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

    public function actionUpload()
    {

        $model = new UploadForm();



    }
}
