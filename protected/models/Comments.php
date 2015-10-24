<?php

Yii::import('application.models._base.BaseComments');

class Comments extends BaseComments {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function addComment($attr) {
        $model = new Comments;
        $model->setAttributes($attr);
        $model->created_at = time();
        $model->updated_at = time();
        if ($model->save(FALSE)) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function getCommentsByEvent($event_id, $limit, $offset)
    {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->offset = $offset;
        $criteria->condition = "event_id = $event_id";
        $data = Comments::model()->findAll($criteria);
    }

}
