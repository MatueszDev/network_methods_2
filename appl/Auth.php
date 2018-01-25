<?php

class Auth
{
    private $_user;
    private $_password;
    private $_data;
    static $dsn = 'sqlite:sql/baza.db' ;
    protected static $db;

    public function __construct($user='', $password='')
    {
      $this->_user = $user;
      $this->_password = $password;
      self::$db = new PDO(self::$dsn);
      self::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION) ;
    }


    public static function listAll()
    {
      $sth = self::$db->prepare("SELECT * FROM user");
      $sth->execute();
      $result = $sth->fetchAll();
      return $result;
    }

    public function check_user_existance()
    {

        $sth = self::$db->prepare("SELECT * FROM user WHERE login='".$this->_user."' AND password='".$this->_password."'");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function addNewUser($name)
    {
        /*$sth = self::$db->prepare("SELECT * FROM user");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;*/
        if($this->_user != '' && $this->_password != '')
        {
            try{
            $sth = self::$db->prepare("INSERT INTO user (name, login, password) VALUES(:name, :login, :password)");
            $sth->bindValue(':name',$name,PDO::PARAM_STR);
            $sth->bindValue(':login',$this->_user,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $resp = ( $sth->execute() ? 'true' : 'false' ) ;
            return $resp ;
          }catch(Exception $exc){
            return "<p> Error </p>".$exc;
          }
        }
        return "Wrong user or pass";
    }
}

?>
