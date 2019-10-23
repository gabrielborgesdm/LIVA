<?php

class Crud
{
    private $host, $user, $password, $dbName, $pdo;

    public function __construct()
    {
        $this->host = "localhost";
        $this->dbName = "liva";
        $this->user = "root";
        $this->password = "";
        try {
            $pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");
            $this->pdo = $pdo;
        } catch (PDOException $e) {
            //echo"Failed to connect to database (/Crud.php): ".$e->getMessage();
            $this->pdo = null;
        }
    }

    public function select($tableName, $fields, $whereCondition = 1)
    {
        try {
            $stmt = null;
            $pdo = $this->pdo;
            $sql = "SELECT $fields FROM $tableName WHERE $whereCondition";
            $stmt = (!empty($pdo)) ? $pdo->query($sql) : null;
        } catch (PDOException $e) {
            //echo "Failed to select from database (/Crud.php): ".$e->getMessage();
        }

        if (!empty($stmt)) {
            $stmtSize = $stmt->rowcount();
        } else {
            $stmtSize = null;
        }
        return ($stmtSize > 0) ? $stmt : null;
    }

    public function insert($tableName, $fields, $arrayValues)
    {
        try {
            $sql = "INSERT INTO $tableName($fields) VALUES(";

            for ($i = 0; $i < count($arrayValues); $i++) {
                $sql .= "\"$arrayValues[$i]\"";

                if ($i != count($arrayValues) - 1) {
                    $sql .= ", ";
                } else {
                    $sql .= ");";
                }
            }
            if (!empty($this->pdo)) {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                return $stmt->rowCount();
            } else {
                return null;
            }
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    public function delete($tableName, $whereCondition = 1)
    {
        try {
            if (!empty($this->pdo)) {
                $stmt = $this->pdo->prepare("DELETE FROM $tableName WHERE $whereCondition");
                $stmt->execute();
                return 1;
            }
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            return null;
        }
    }

    public function update($tableName, $id, $arrayKeys, $arrayValues)
    {
        try {
            if (!empty($this->pdo)) {

                $update = "UPDATE $tableName SET ";
                for ($i = 0; $i < count($arrayKeys); $i++) {
                    $update .= "$arrayKeys[$i] = \"$arrayValues[$i]\",";
                }
                $update = rtrim($update, ',');
                $update .= " WHERE id = \"$id\";";
                $stmt = $this->pdo->prepare($update);
                $stmt->execute();
                return 1;
            }    
        } catch (PDOException $e) {
            //echo 'Error: ' . $e->getMessage();
            return 0;
        }
    }

    /**
     * Get the value of pdo
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * Set the value of pdo
     *
     * @return  self
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}
