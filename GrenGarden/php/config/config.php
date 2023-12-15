<?php

class db
{
    private $host = "db";
    private $user = "root";
    private $password = "";
    private $database = "greengarden";
    private $charset = "utf8";

    // private $host = "localhost";
    // private $user = "root";
    // private $password = "root";
    // private $database = "greengarden";
    // private $charset = "utf8";


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
    //Selection pour tout afficher avec un foreach et un param
    public function getAll($query, $param)
    {
        $results = array();

        $stmt = $this->bdd->prepare($query);

        if (!$stmt) {
            $this->error = $this->bdd->errorInfo();
            return false;
        } else {
            $stmt->execute($param);
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
    public function getAloneParam($query, $param)
    {
        $results = array();

        $stmt = $this->bdd->prepare($query);

        if (!$stmt) {
            $this->error = $this->bdd->errorInfo();
            return false;
        } else {
            $stmt->execute($param);
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
    public function countNumCommande()
    {
        $sql = "SELECT count(Num_Commande) FROM t_d_commande";

        return $this->getResults($sql);
    }
    public function countNumProduit()
    {
        $sql = "SELECT count(Id_Produit) FROM t_d_produit";

        return $this->getResults($sql);
    }
    public function countNumCat()
    {
        $sql = "SELECT count(Id_Categorie) FROM t_d_categorie";

        return $this->getResults($sql);
    }

    public function getLastId()
    {
        $sql = "SELECT max(Id_User) FROM t_d_user";

        return $this->getAlone($sql);
    }
    public function getLastCat()
    {
        $sql = "SELECT max(Id_Categorie) FROM t_d_categorie";

        return $this->getAlone($sql);
    }
    //
    public function getCat()
    {
        $sql = "SELECT * FROM t_d_categorie where Id_Categorie_Parent IS NULL";
        return $this->getResults($sql);
    }
    public function getCatAll()
    {
        $sql = "SELECT * FROM t_d_categorie";
        return $this->getResults($sql);
    }
    public function getCatNull($param = [])
    {
        $sql = "SELECT Id_Categorie FROM t_d_categorie where Id_Categorie_Parent = :id_cat";
        return $this->getAll($sql, $param);
    }
    public function getCatNom($param = [])
    {
        $sql = "SELECT * FROM t_d_categorie WHERE Id_Categorie = :cat";
        return $this->getAloneParam($sql, $param);
    }
    public function getFourUp($param = [])
    {
        $sql = "SELECT * FROM t_d_fournisseur WHERE Id_Fournisseur = :four";
        return $this->getAloneParam($sql, $param);
    }
    public function getProduct($param = [])
    {
        $sql = "SELECT * FROM t_d_produit where Id_Categorie = :id_cat";
        return $this->getAll($sql, $param);
    }
    public function getSousCat($param = [])
    {
        $sql = "SELECT * FROM t_d_categorie where Id_Categorie_Parent = :id_cat";
        return $this->getAll($sql, $param);
    }
    public function getProductAll()
    {
        $sql = "SELECT * FROM t_d_produit order by Id_Produit DESC";
        return $this->getResults($sql);
    }
    public function getProductInfo($param = [])
    {
        $sql = "SELECT * FROM t_d_produit where Id_Produit = :id_produit";
        return $this->getAloneParam($sql, $param);
    }
    //
    public function getUser($param = [])
    {
        $sql = "SELECT * FROM t_d_user WHERE Login = :log";
        return $this->getAloneParam($sql, $param);
    }
    //
    public function getClient()
    {
        $sql = "SELECT * FROM t_d_client";
        return $this->getResults($sql);
    }
    // 
    public function getPage($nombre)
    {
        // On détermine le nombre total d'articles
        $sql = 'SELECT COUNT(*) AS users FROM `t_d_client`;';

        // On prépare la requête
        $query = $this->bdd->prepare($sql);

        // On exécute
        $query->execute();

        // On récupère le nombre d'articles
        $result = $query->fetch();

        $nbArticles = (int) $result['users'];

        // On détermine le nombre d'articles par page
        $parPage = $nombre;

        // On calcule le nombre de pages total
        return ceil($nbArticles / $parPage);
    }
    public function getPremier($currentPage, $parPage)
    {

        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;

        $sql = 'SELECT * FROM `t_d_client` ORDER BY `Id_Client` DESC LIMIT :premier, :parpage;';

        // On prépare la requête
        $query = $this->bdd->prepare($sql);

        $query->bindValue(':premier', $premier, PDO::PARAM_INT);
        $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

        // On exécute
        $query->execute();

        // On récupère les valeurs dans un tableau associatif
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    //
    public function forEarchFour()
    {
        $sql = "SELECT * FROM t_d_fournisseur";
        return $this->getResults($sql);
    }
    public function forEarchCat()
    {
        $sql = "SELECT * FROM t_d_categorie";
        return $this->getResults($sql);
    }
    public function getCatProduit($param = [])
    {
        $sql = "SELECT Id_Categorie FROM t_d_categorie WHERE Libelle = :lib";
        return $this->getAloneParam($sql, $param);
    }
    public function getFour($param = [])
    {
        $sql = "SELECT Id_Fournisseur FROM t_d_fournisseur WHERE Nom_Fournisseur = :lib";
        return $this->getAloneParam($sql, $param);
    }
    public function insertProduit($param = [])
    {
        $sql = "INSERT INTO t_d_produit (Taux_TVA, Nom_Long, Nom_court, Ref_fournisseur, Photo, Prix_Achat, Id_Fournisseur, Id_Categorie) VALUES (:tva, :noml, :nomc, :refs, :ph, :prix, :idFour, :idCat)";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    public function suppUser($param = [])
    {
        $sql = "DELETE FROM t_d_client WHERE Id_Client = :client";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    public function suppProduct($param = [])
    {
        $sql = "DELETE FROM t_d_produit WHERE Id_Produit = :produit";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    //
    public function updateClient($param = [])
    {
        $sql = "UPDATE t_d_client SET Nom_Societe_Client = :soc, Nom_Client = :nom, Prenom_Client = :prenom, Mail_Client = :mail, Tel_Client = :tel, DelaiPaiement_Client = :delai, Num_Client = :num where Id_Client = :idClient";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    public function updateProduit($param = [])
    {
        $sql = "UPDATE t_d_produit SET Taux_TVA = :tva, Nom_Long = :nomL, Nom_court = :nomC, Ref_fournisseur = :refs, Photo = :img, Prix_Achat = :prix, Id_Fournisseur = :fours, Id_Categorie = :cat where Id_Produit = :idProduit";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    //
    public function addCat($param = []){
        $sql = "INSERT INTO t_d_categorie (Libelle, img) VALUES (:lib, :img)";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    public function suppCat($param){
        $sql = "DELETE FROM t_d_categorie WHERE Id_Categorie = :cat_id";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
    public function suppCatProduit($param){
        $sql = "DELETE FROM t_d_produit WHERE Id_Categorie = :cat_id";
        $sql = $this->bdd->prepare($sql);
        $sql->execute($param);
    }
}
