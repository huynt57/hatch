<?php

Yii::import('application.models._base.BaseFeedbackUser');

class FeedbackUser extends BaseFeedbackUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}