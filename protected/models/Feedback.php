<?php

Yii::import('application.models._base.BaseFeedback');

class Feedback extends BaseFeedback
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function addFeedback($attr)
        {
            if(is_array($attr))
            {
                $model = new Feedback;
                $model->setAttributes($attr);
                if($model->save(FALSE))
                {
                    return TRUE;
                }
            }
            return FALSE;
        }
        
        public function getFeedbackByEvent($event_id, $limit, $offset)
        {
           $criteria = new CdbCriteria;
           $criteria->limit = $limit;
           $criteria->offset = $offset;
           $criteria->condition = "event_id = $event_id";
           $data = Feedback::model()->findAll($criteria);
           return $data;
        }
}