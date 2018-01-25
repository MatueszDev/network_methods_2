<?php

class Survey
{
    private $_login;


    static $dsn = 'sqlite:sql/polldb.db' ;
    protected static $db;

    public function __construct($login)
    {
        $this->_login = $login;

        self::$db = new PDO(self::$dsn);
        self::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION) ;
    }


    public static function listAll()
    {
        $sth = self::$db->prepare("SELECT * FROM poll");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }



    public function addNewRecord($age, $sex, $cs, $lol, $gw)
    {
        try{
            $sth = self::$db->prepare("INSERT INTO poll (login, sex, age, cs, lol, gw, data) VALUES(:login, :sex, :age, :cs, :lol, :gw, :data)");
            $sth->bindValue(':login',$this->_login,PDO::PARAM_STR);
            $sth->bindValue(':sex',$sex,PDO::PARAM_STR);
            $sth->bindValue(':age',$age,PDO::PARAM_INT);
            $sth->bindValue(':cs',$cs,PDO::PARAM_INT);
            $sth->bindValue(':lol',$lol,PDO::PARAM_INT);
            $sth->bindValue(':gw',$gw,PDO::PARAM_INT);
            $sth->bindValue(':data',date("Y-m-d H:i:s"),PDO::PARAM_STR);
            $resp = ( $sth->execute() ? 'true' : 'false' ) ;
            return $resp ;
          }catch(Exception $exc){
            return "<p> Error </p>".$exc;
          }

        return "Wrong user or pass";
    }

    public function countNumberOfRecords()
    {
        try{
            $query = self::$db->prepare("SELECT count(*) from poll WHERE login = ':login'");
            $query->bindValue(':login', $this->_login, PDO::PARAM_STR);
            $result = $sth->execute();
            return $result;
        }catch(Exception $exc){
          return "<p> Error </p>".$exc;
        }

    }


}

?>
