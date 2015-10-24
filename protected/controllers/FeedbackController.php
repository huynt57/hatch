<?php

class FeedbackController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            $model = Feedback::model()->addFeedback($attr);
            if ($model) {
                ResponseHelper::JsonReturnSuccess($model, 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Server Error');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    public function actionAddQuestionForFeedback()
    {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (Feedback::model()->addQuestionFeedback($attr)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Server Error');
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionGetFeedbackByEvent() {
        $request = Yii::app()->request;
        try {
            $event_id = StringHelper::filterString($request->getQuery('event_id'));

            $data = Feedback::model()->getFeedbackByEvent($event_id);
            ResponseHelper::JsonReturnSuccess($data, 'Success');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function actionAddUserFeedback() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (Feedback::model()->addUserFeedback($attr)) {
                ResponseHelper::JsonReturnSuccess('', 'Success');
            } else {
                ResponseHelper::JsonReturnError('', 'Server Error');
            }
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
