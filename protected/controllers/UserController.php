<?php

class UserController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLoginWithFacebook() {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $facebook_id = StringHelper::filterString($request->getPost('facebook_id'));
                $age = StringHelper::filterString($request->getPost('age'));
                $gender = StringHelper::filterString($request->getPost('gender'));
                $facebook_access_token = StringHelper::filterString($request->getPost('facebook_access_token'));
                $photo = StringHelper::filterString($request->getPost('photo'));
                $username = StringHelper::filterString($request->getPost('username'));
                $device_id = StringHelper::filterString($request->getPost('device_id'));
                User::model()->processLoginWithFacebook($facebook_id, $age, $gender, $facebook_access_token, $photo, $username, $device_id);
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }
    
    public function actionLoginWithEmail()
    {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $email = StringHelper::filterString($request->getPost('email'));
                $password = StringHelper::filterString($request->getPost('password'));
               
                User::model()->processLoginWithEmail($email, $password);
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }
    
    public function actionAddPoint()
    {
        $request = Yii::app()->request;
        if ($request->isPostRequest && isset($_POST)) {
            try {
                $event_id = StringHelper::filterString($request->getPost('event_id'));
                $user_id = StringHelper::filterString($request->getPost('user_id'));             
                User::model()->addPoint($event_id, $user_id);
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } catch (exception $e) {
                var_dump($e->getMessage());
            }
            Yii::app()->end();
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
