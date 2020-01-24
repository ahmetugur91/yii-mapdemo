<?php


class Helper
{

    private static $user = null;

    public static function user()
    {
        if(!self::$user)
        {
            $user = Location::model()->find(Yii::app()->user->getState("id"));
            self::$user = $user;
            return $user;
        }

        return self::$user;
    }

}