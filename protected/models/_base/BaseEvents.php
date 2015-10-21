<?php

/**
 * This is the model base class for the table "tbl_events".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Events".
 *
 * Columns in table "tbl_events" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $event_id
 * @property string $name
 * @property string $images
 * @property string $description
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $status
 * @property integer $date
 * @property string $address
 * @property integer $type
 *
 */
abstract class BaseEvents extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_events';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Events|Events', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('created_at, created_by, updated_at, status, date, type', 'numerical', 'integerOnly'=>true),
			array('name, images, description, address', 'safe'),
			array('name, images, description, created_at, created_by, updated_at, status, date, address, type', 'default', 'setOnEmpty' => true, 'value' => null),
			array('event_id, name, images, description, created_at, created_by, updated_at, status, date, address, type', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'event_id' => Yii::t('app', 'Event'),
			'name' => Yii::t('app', 'Name'),
			'images' => Yii::t('app', 'Images'),
			'description' => Yii::t('app', 'Description'),
			'created_at' => Yii::t('app', 'Created At'),
			'created_by' => Yii::t('app', 'Created By'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'status' => Yii::t('app', 'Status'),
			'date' => Yii::t('app', 'Date'),
			'address' => Yii::t('app', 'Address'),
			'type' => Yii::t('app', 'Type'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('event_id', $this->event_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('images', $this->images, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('created_at', $this->created_at);
		$criteria->compare('created_by', $this->created_by);
		$criteria->compare('updated_at', $this->updated_at);
		$criteria->compare('status', $this->status);
		$criteria->compare('date', $this->date);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('type', $this->type);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}