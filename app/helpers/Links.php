<?php

namespace App\Helpers;

class Links extends \Sinevia\LinkUtils
{
    public static function apiUrl($queryData = array())
    {
        return self::buildUrl('/api', $queryData);
    }

    public static function authLogin($queryData = array())
    {
        return self::buildUrl('/auth/login', $queryData);
    }

    public static function authLogout($queryData = array())
    {
        return self::buildUrl('/auth/logout', $queryData);
    }

    public static function authPasswordChange($queryData = array())
    {
        return self::buildUrl('/auth/password-change', $queryData);
    }

    public static function authPasswordRestore($queryData = array())
    {
        return self::buildUrl('/auth/password-restore', $queryData);
    }

    public static function authRegister($queryData = array())
    {
        return self::buildUrl('/auth/register', $queryData);
    }

    public static function guestHome($queryData = array())
    {
        return self::buildUrl('/', $queryData);
    }

    public static function userHome($queryData = array())
    {
        return self::buildUrl('/user', $queryData);
    }

    public static function buildUrl($path, $queryData = array())
    {
        if (isset($queryData['PHPSESSID']) == false) {
            $queryData['PHPSESSID'] = session_id();
        }
        return parent::buildUrl($path, $queryData);
    }
}