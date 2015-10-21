<?php

Yii::import('application.models._base.BaseEventType');

class EventType extends BaseEventType
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}