<?php

class db
{
    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $database = "greengarden";
    private $charset = "utf8";

    private $bdd;

    private $error;

    public function disconnect()
    {
        $this->bdd = null;
    }

    public function connexion()
    {

        try {
            $this->bdd = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=' . $this->charset, $this->user, $this->password);
        } catch (Exception $e) {
            $this->error = 'Erreur : ' . $e->getMessage();
        }
    }

    //
        //Selection pour tout afficher avec un foreach
        public function getResults($query)
        {
            $results = array();
    
            $stmt = $this->bdd->prepare($query);
    
            if (!$stmt) {
                $this->error = $this->bdd->errorInfo();
                return false;
            } else {
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        //Selection pour tout afficher avec un foreach
        public function getAlone($query)
        {
            $results = array();
    
            $stmt = $this->bdd->prepare($query);
    
            if (!$stmt) {
                $this->error = $this->bdd->errorInfo();
                return false;
            } else {
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    //

    public function register($param = [])
    {
        $sql = "INSERT INTO t_d_user (Id_UserType, Login, Password) VALUES (:id, :log, :pass)";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }

    public function registerClient($param = [])
    {
        $sql = "INSERT INTO t_d_client (Nom_Societe_Client, Nom_client, Prenom_Client, Mail_Client, Tel_Client, Id_Commercial, Id_Type_Client, DelaiPaiement_Client, Num_Client, id_user) VALUES (:societe, :nom, :prenom, :mail, :tel, :commerce, :type, :delai, :num, :user)";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }

    //
    public function countNumClient()
    {
        $sql = "SELECT count(Num_Client) FROM t_d_client";

        return $this->getResults($sql);
    }

    public function getLastId()
    {
        $sql = "SELECT max(Id_User) FROM t_d_user";

        return $this->getAlone($sql);
    }
}
