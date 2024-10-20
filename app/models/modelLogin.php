<?php
require_once "config.php";

class userModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
                ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
        $this->_deploy();
    }

    private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END

		END;
            $this->db->query($sql);
        }
    }

    function getUserName($userName)
    {

        $query = $this->db->prepare("SELECT * FROM user WHERE username = ?");
        $query->execute([$userName]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }
}
