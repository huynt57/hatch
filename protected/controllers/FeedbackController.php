<?php

class FeedbackController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAdd() {
        try {
            $attr = StringHelper::filterArrayString($_POST);
            if (Feedback::model()->addFeedback($attr)) {
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
            $limit = StringHelper::filterString($request->getQuery('limit'));
            $offset = StringHelper::filterString($request->getQuery('offset'));

            $data = Feedback::model()->getFeedbackByEvent($event_id, $limit, $offset);
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
