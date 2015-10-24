<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function processLoginWithFacebook($facebook_id, $age, $gender, $facebook_access_token, $photo, $username, $device_id) {
        $check = User::model()->findByAttributes(array('facebook_id' => $facebook_id));
        if ($check) {
            $check->updated_at = time();
            if ($check->save(FALSE)) {
                Yii::app()->session['user_id'] = $check->id;
                ResponseHelper::JsonReturnSuccess($check, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } else {
            $model = new User;
            $model->facebook_id = $facebook_id;
            $model->age = $age;
            $model->gender = $gender;
            $model->facebook_access_token = $facebook_access_token;
            $model->photo = $photo;
            $model->username = $username;
            $model->device_id = $device_id;
            $model->created_at = time();
            $model->updated_at = time();
            $model->status = 1;
            if ($model->save(FALSE)) {
                Yii::app()->session['user_id'] = $model->id;
                ResponseHelper::JsonReturnSuccess($model, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        }
    }

    public function getUserById($id) {
        $returnArr = array();
        $data = User::model()->findByPk($id);
        if ($data) {
            $returnArr['user_id'] = $data->id;
            $returnArr['username'] = $data->username;
            $returnArr['photo'] = $data->photo;
            return $returnArr;
        }
        return FALSE;
    }

    public function processLoginWithEmail($email, $password) {
        $check = User::model()->findByAttributes(array('email' => $email));
        if ($check) {
            $check->updated_at = time();
            if ($check->save(FALSE)) {
                Yii::app()->session['user_id'] = $check->id;
                ResponseHelper::JsonReturnSuccess($check, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        } else {
            $model = new User;
            $model->username = $email;
            $model->password = md5($password);
            $model->created_at = time();
            $model->updated_at = time();
            $model->status = 1;
            if ($model->save(FALSE)) {
                Yii::app()->session['user_id'] = $model->id;
                ResponseHelper::JsonReturnSuccess($model, "Success");
            } else {
                ResponseHelper::JsonReturnError("", "Server Error");
            }
        }
    }

    public function addPoint($event_id, $user_id) {
        $feedBacks = FeedbackUser::model()->findAllByAttributes(array('event_id' => $event_id, 'user_id' => $user_id));
        $cnt = count($feedBacks);
        switch ($cnt) {
            case 0:
                $this->addPointForUser($user_id, 1000);
                break;
            case 1:
                $this->addPointForUser($user_id, 900);
                break;
            case 2:
                $this->addPointForUser($user_id, 800);
                break;
            case 3:
                $this->addPointForUser($user_id, 700);
                break;
            case 4:
                $this->addPointForUser($user_id, 600);
                break;
            case 5:
                $this->addPointForUser($user_id, 500);
                break;
            case 6:
                $this->addPointForUser($user_id, 400);
                break;
            case 7:
                $this->addPointForUser($user_id, 300);
                break;
            case 8:
                $this->addPointForUser($user_id, 200);
                break;
            case 9:
                $this->addPointForUser($user_id, 100);
                break;
            case 10:
                $this->addPointForUser($user_id, 50);
                break;
            default:
                $this->addPointForUser($user_id, 10);
                break;
        }
    }

    public function addPointForUser($user_id, $point) {
        $user = User::model()->findByPk($user_id);
        $user->point+=$point;
        $user->save(FALSE);
    }

}
