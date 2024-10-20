
<?php
require_once "config.php";

class TeamModel
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

    // SELECCIONAR TODOS LOS EQUIPOS (PARA LUEGO MOSTRARLOS EN VIEW)
    public function getTeams()
    {

        $query = $this->db->prepare('SELECT * FROM equipos');
        $query->execute();

        $teams_List = $query->fetchAll(PDO::FETCH_OBJ);

        return $teams_List;
    }

    // OBTENER LA DATA DE UN EQUIPO
    public function getTeamData($id)
    {
        $query = $this->db->prepare('SELECT * FROM equipos WHERE id_equipo = ?');
        $query->execute([$id]);

        $team = $query->fetch(PDO::FETCH_OBJ);
        return $team;
    }

    // CONOCER LOS JUGADORES QUE FORMAN PARTE DE UN EQUIPO
    public function Players_From_specificClub($id)
    {
        $query = $this->db->prepare('SELECT * FROM jugadores WHERE club = ?');
        $query->execute([$id]);

        $teamlist = $query->fetchAll(PDO::FETCH_OBJ);
        return $teamlist;
    }

    // CREAR NUEVO EQUIPO
    public function insertNewClub($clubName, $foundation, $stadium, $badge)
    {
        $query = $this->db->prepare('INSERT INTO equipos (nombre, fundacion, estadio, logo) VALUES (?, ?, ?, ?)');
        $query->execute([$clubName, $foundation, $stadium, $badge]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    // ELIMINAR EQUIPO
    public function deleteClub($id)
    {
        $query = $this->db->prepare('DELETE FROM equipos WHERE id_equipo= ?');
        $query->execute([$id]);
    }

    // EDITAR EQUIPO
    public function updateClub($nameClub, $foundation, $stadium, $badge, $id)
    {
        $query = $this->db->prepare('UPDATE equipos SET nombre = ?, fundacion = ?, estadio = ?, logo= ? WHERE id_equipo = ?');
        $query->execute([$nameClub, $foundation, $stadium, $badge, $id]);


        $id = $this->db->lastInsertId();

        return $id;
    }
}
