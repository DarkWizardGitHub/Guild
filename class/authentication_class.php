<?php

class Authentication
{

  public function __construct()
  {

  }

  public function statuscheck()
  {
    if (!empty($_SESSION['user_parameter']['user_id']) && $_SESSION['user_parameter']['signintime'] + 60*60*3 > time())
    {
      // サインインしている場合
      return true;
    } else {
      // サインインしていない場合、または時間切れの場合
      return false;
    }
  }


  public function autosignin()
  {
    require_once('database_class.php');
    $database = new Database();

    if(!empty($_COOKIE['username']) && !empty($$_COOKIE['password']))
    {
      $returnvalue=$database->mysqlquery('SELECT * FROM `test2` WHERE `username`=? AND `password`=?', $data=array($_COOKIE['username'], sha1($_COOKIE['password'])));
      if ($returnvalue == false)
      {
      // 認証失敗
      // 認証失敗時は返り値としてfalseを返す
        return false;
      } else {
      // 認証成功
        $retentionperiod=60*60*3;
        setcookie('username', $cookieusername, time()+$retentionperiod);
        setcookie('password', $cookiepassword, time()+$retentionperiod);

        $_SESSION['user_parameter']['user_id']=$returnvalue['user_id'];
        $_SESSION['user_parameter']['signintime'] = time();
      // 認証成功時は返り値としてtrueを返す
        return true;
      }
    }
  }


  public function signin($username, $password)
  {
    require_once('database_class.php');
    $database = new Database();

    if(!empty($username) && !empty($password))
    {
    $returnvalue=$database->mysqlquery('SELECT * FROM `test2` WHERE `username`=? AND `password`=?', $data=array($username, $password));
// var_dump($returnvalue);
      if ($returnvalue == false)
      {
      // 認証失敗
      // 認証失敗時は返り値としてfalseを返す
        return false;
      } else {
      // 認証成功
      setcookie('username', $username, time()+60*60);
      setcookie('password', $password, time()+60*60);
      // 認証成功時は返り値としてユーザーIDと現在時刻を返す
      // return array($returnvalue[0]['user_id'], time());
      return array($returnvalue[0], time());
      }
    }
  }


  public function signout($destination="")
  {
    session_start();

    // 全てのセッション変数を削除
    $_SESSION = array();

    // セッションの情報を有効期限切れにする
    if (ini_get('session.use_cookies'))
    {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    // セッションの情報を破棄
    session_destroy();

    // cookieの情報も削除
    setcookie('username', '', time() - 3000);
    setcookie('password', '', time() - 3000);

    header("Location:{$destination}");
    exit;
  }


  // インスタンス後のテスト用関数
  function test()
  {
    // session_start();
    $_SESSION['user_parameter']['user_id']="test";
    $_SESSION['user_parameter']['signintime']=time();
    // $_SESSION['user_parameter']['signintime']="time()";
    echo '<pre>';
    var_dump($_SESSION['user_parameter']['user_id']);
    var_dump($_SESSION['user_parameter']['signintime']);
    echo '</pre>';
    // session_destroy();
  }
}

?>