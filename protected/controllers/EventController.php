<?php

class EventController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAddEvent() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            $image  = UploadHelper::getUrlUploadSingleImage($_FILES['image'], $_POST['created_by']);
            if (Events::model()->addEvent($attr, $image)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Server Error');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetEvent() {
        $request = Yii::app()->request;
        try {
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $data = Events::model()->getEvent($limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetEventByUser() {
        $request = Yii::app()->request;
        try {
            $user_id = StringHelper::filterString($request->getQuery('user_id'));
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));
            $data = Events::model()->getEvent($user_id, $limit, $offset);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
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
