<?php

require_once "config.php";

class TaskModel
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

    // Seleccionar todos los jugadores
    public function getPlayers()
    {
        $query = $this->db->prepare('SELECT * FROM jugadores');
        $query->execute();

        $playersList = $query->fetchAll(PDO::FETCH_OBJ);

        return $playersList;
    }

    // Seleccionar un jugador especifico
    public function specificPlayer($id)
    {
        $query = $this->db->prepare("SELECT * FROM jugadores WHERE id_jugador= ?");
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Obtener el nombre del equipo al que pertenece un jugador (para su pagina especifica)
    public function getTeamData($club)
    {
        $query = $this->db->prepare('SELECT nombre FROM equipos WHERE id_equipo= ?');
        $query->execute([$club]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Insertar un nuevo jugador
    public function insertNewPlayer($name, $age, $club, $marketValue, $position)
    {
        $query = $this->db->prepare('INSERT INTO jugadores(nombre, edad, club, valor_de_mercado, posicion) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name, $age, $club, $marketValue, $position]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    // Obtener los clubes a elegir en añadir jugador
    public function get_Club_Options()
    {
        $query = $this->db->prepare('SELECT id_equipo, nombre FROM equipos');
        $query->execute();

        $clubOptions = $query->fetchAll(PDO::FETCH_OBJ);

        return $clubOptions;
    }

    // Eliminar un jugador existente
    public function deleteSpecificPlayer($id)
    {
        $query = $this->db->prepare('DELETE FROM jugadores WHERE id_jugador= ?');
        $query->execute([$id]);
    }

    // Editar un jugador existente
    public function updatePlayer($name, $age, $club, $marketValue, $position, $id)
    {
        $query = $this->db->prepare('UPDATE jugadores SET nombre = ?, edad = ?, club = ?, valor_de_mercado = ?, posicion = ? WHERE id_jugador = ?');
        $query->execute([$name, $age, $club, $marketValue, $position, $id]);


        $id = $this->db->lastInsertId();

        return $id;
    }
}
