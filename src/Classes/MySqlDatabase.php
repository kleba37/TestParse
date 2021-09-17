<?php


namespace TestParser\Classes;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\VarDumper\VarDumper;
use PDO;

class MySqlDatabase
{
    protected static $instance;
    private string $user = "";
    private string $password = "";
    private string $host ="";
    private string $database = "";
    private $pathConfig = "config.yaml";
    private static PDO $connect;

    public function getConnect() :  ?PDO
    {
        return $this->connect;
    }

    public function getConfig() : bool
    {
        $file = Yaml::parseFile($_SERVER['DOCUMENT_ROOT'] . "/".$this->pathConfig);
        $config = $file['Mysql'] ? $file['Mysql'] : $file['mysql'] ;

        if (!$config & !$config['host'] & !$config['user'] & !$config['password'] & !$config['database'] ) return false;
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        return true;
    }

    private function __construct()
    {
        $this->getConfig();
        $this->connect = new PDO("mysql:". "host=" . $this->host . ";dbname=" . $this->database . ";charset=UTF8;port=3306;", $this->user, $this->password);
    }

    public static function getInstance()
    {
        if(!self::$instance) self::$instance = new self();

        return self::$instance;
    }
}