<?php

Yii::import('application.models._base.BaseFeedbackQuestion');

class FeedbackQuestion extends BaseFeedbackQuestion
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function addFeedbackQuestion($attr)
        {
            if(is_array($attr)) {
                $model = new FeedbackQuestion;
                $model->setAttributes($attr);
                if($model->save(FALSE))
                {
                    return TRUE;
                }
            }
            return FALSE;
        }
        
        
}