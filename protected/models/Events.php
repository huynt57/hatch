<?php

Yii::import('application.models._base.BaseEvents');

class Events extends BaseEvents
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function addEvent($attr)
        {
            $model = new Events;
            $model->setAttributes($attr);
            if($model->save(FALSE))
            {
                return TRUE;
            }
            return FALSE;
        }
        
        public function getEvent($limit, $offset)
        {
            $criteria = new CDbCriteria;
            $criteria->limit = $limit;
            $criteria->offset = $offset;
            $result = Events::model()->findAll($criteria);
            $returnArr = array();
            foreach($result as $item)
            {
                $itemArr['name'] = $item->name;
                $itemArr['images'] = $item->images;
                $itemArr['description'] = $item->description;
                $itemArr['status'] = $item->status;
                $itemArr['date'] = $item->date;
                $itemArr['address'] = $item->address;
                $itemArr['type'] = $item->type;
                $returnArr[] = $itemArr;
            }
            return $returnArr; 
        }
        
         public function getEventByUser($user_id, $limit, $offset)
        {
            $criteria = new CDbCriteria;
            $criteria->created_by = $user_id;
            $criteria->limit = $limit;
            $criteria->offset = $offset;
            $result = Events::model()->findAll($criteria);
            $returnArr = array();
            foreach($result as $item)
            {
                $itemArr['name'] = $item->name;
                $itemArr['images'] = $item->images;
                $itemArr['description'] = $item->description;
                $itemArr['status'] = $item->status;
                $itemArr['date'] = $item->date;
                $itemArr['address'] = $item->address;
                $itemArr['type'] = $item->type;
                $returnArr[] = $itemArr;
            }
            return $returnArr; 
        }
}