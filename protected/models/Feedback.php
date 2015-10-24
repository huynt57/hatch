<?php

Yii::import('application.models._base.BaseFeedback');

class Feedback extends BaseFeedback {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addFeedback($attr) {
        if (is_array($attr)) {
            $model = new Feedback;
            $model->created_at = time();
            $model->updated_at = time();
            $model->setAttributes($attr);
            if ($model->save(FALSE)) {
                return $model;
            }
        }
        return FALSE;
    }

    public function getFeedbackByEvent($event_id) {
        $feedbacks = Feedback::model()->findAllByAttributes(array('event_id' => $event_id));
        $returnArr = array();
        foreach ($feedbacks as $item) {
            $itemArr = $this->getQuestionByFeedback($item->feedback_id);
            if (!empty($itemArr)) {
                $returnArr[] = $itemArr;
            }
        }
        return $returnArr;
    }

    public function getQuestionByFeedback($feedback_id) {
        $data = FeedbackQuestion::model()->findAllByAttributes(array('feedback_id' => $feedback_id));
        return $data;
    }

    public function addUserFeedback($attr) {
        if (is_array($attr)) {
            $model = new FeedbackUser;
            $model->setAttributes($attr);
            if ($model->save(FALSE)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public function addQuestionFeedback($attr) {
        if (is_array($attr)) {
            $model = new FeedbackQuestion();
            $model->created_at = time();
            $model->updated_at = time();
            $model->setAttributes($attr);
            if ($model->save(FALSE)) {
                return TRUE;
            }
        }
        return FALSE;
    }

}
