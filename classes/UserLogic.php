<?php

require_once '../dbconnect.php';
ini_set('display_errors', true);

class UserLogic
{
    /**
     * ユーザ登録
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result = false;
        $sql = 'INSERT INTO gs_login_table (name,email,password,manager)
        VALUES (?,?,?,?)';

        //date into arary
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
        $arr[] = $userData['manager'];


        try {
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;
        } catch (\Exception $e) {
            echo $e;
            return $result;
        }
    }

    /**
     * Login
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($username, $email, $password)
    {
        $result = false;
        $user = self::getUserByEmail($username, $email);

        if (!$user) {
            $_SESSION['msg'] = 'ユーザー名 or emailが違います!';
            return $result;
        }

        //pw go normal
        if (password_verify($password, $user['password'])) {
            //Login sucucess
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }
        $_SESSION['msg'] = 'パスワードが違います！';
        return $result;
    }

    /**
     * search user from email
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($username, $email)
    {

        $sql = 'SELECT * FROM gs_login_table WHERE name=? AND email=?';

        //date into arary
        $arr = [];
        $arr[] = $username;
        $arr[] = $email;

        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            echo $e;
            return false;
        }
    }

    // 管理者用①
    public static function loginManager($username, $email, $password)
    {
        $result = false;
        $user = self::getUserByEmailManager($username, $email);

        if (!$user) {
            $_SESSION['msg'] = 'ユーザー名 or emailが違います!';
            return $result;
        }

        if ($user['manager'] === '0') {
            $_SESSION['msg'] = '管理者ではありません';
            return $result;
        }

        //pw go normal
        if (password_verify($password, $user['password'])) {
            //Login sucucess
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }
        $_SESSION['msg'] = 'パスワードが違います！';
        return $result;
    }

    // 管理者用②
    /**
     * search user from email
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmailManager($username, $email)
    {

        $sql = 'SELECT * FROM gs_login_table WHERE name=? AND email=?';

        //date into arary
        $arr = [];
        $arr[] = $username;
        $arr[] = $email;

        try {
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            echo $e;
            return false;
        }
    }




    /**
     * Login check
     * @param void
     * @return bool $result
     */
    public static function checkLogin()
    {
        $result = false;

        // if login user is not in session, it will be false
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
            return $result = true;
        }

        return $result;
    }

    public static function checkLoginManager()
    {
        $result = false;

        // if login user is not in session, it will be false
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0 && $_SESSION['login_user']['manager'] === 1) {
            return $result = true;
        }

        return $result;
    }


    /**
     * Logout
     */
    public static function logout()
    {
        $_SESSION = array();
        session_destroy();
    }
}
