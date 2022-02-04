<?php
class Database
{
    protected $connect;

    // Create connect
    public function __construct()
    {
        if(!isset($this->connect)){
            $config = parse_ini_file('config.ini');
            @$link = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
        }

        if (mysqli_connect_errno()) { // connect fail
            die('<h4>Fail to connect database</h4></br>Error: ' . mysqli_connect_error());
        }else {
            $this->connect = $link; // connect success
        }
    }

    public function query($queryString){
        $conn = $this->connect;
        $result = $conn->query($queryString);
        return $result;
    }

    //close database
    public function __destruct(){
        mysqli_close($this->connect);
    }
    
}
