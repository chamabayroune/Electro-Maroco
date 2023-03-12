<?php
require_once 'connection.php';
class CommandeModel {
    private $posts;
    public function addCommandeToDb(){
        $conn=connect_to_db();
        $idclient = $_SESSION['client']['id'];
        $stmt=$conn->query("INSERT INTO commande (idclient,datecreation) VALUES ($idclient,NOW());");
        $lastInsertId = $conn->lastInsertId();
        return $lastInsertId;
        // ) VALUES (".$post['quantite']."",
        // '".$post['date_envoi']."','".$post['date_livraison']."',$_SESSION['client']['id']");
    }
    public function addproduitcommande($idc,$idp,$q){
        $conn = connect_to_db();

        $stmt=$conn->query("insert into commande_produit(idcommande,idproduit,quantite) values($idc,$idp,$q)");
    }
    function selectFromDb($element,$id){
        $conn=connect_to_db();
        $stmt=$conn->query("SELECT $element from commande where id=$id");
        $result=$stmt->fetch();
        return $result;
    }
    public function getCommandeFromDb(){
        $conn=connect_to_db();
            $stmt=$conn->query("SELECT*from commande");
        
        $produit=$stmt->fetchAll();
        return $produit;
    }
    public function getCommande($id){
        $conn=connect_to_db();
        $stmt=$conn->query("select * from commande where id=$id;");
    
    $produit=$stmt->fetchAll();
    return $produit;
    }
    public function getpr($idc,$idclient){
        $conn = connect_to_db();
        $stmt = $conn->query("select  produit.namep,client.name,commande_produit.quantite  from produit inner join commande_produit 
    inner join commande inner join client on commande_produit.idproduit=produit.id  
WHERE commande_produit.idcommande=$idc and commande.idclient=$idclient GROUP BY produit.namep;");
    $produit=$stmt->fetchAll();
    return $produit;
    }
    function getprix($id,$idc){
        $conn = connect_to_db();
        $stmt = $conn->query("SELECT SUM(commande_produit.quantite*produit.prixfinal) as total 
        from commande_produit INNER JOIN produit on commande_produit.idproduit=produit.id 
        inner join commande on commande_produit.idcommande=commande.idcommande  where
         commande.idclient=$id AND commande.idcommande=$idc");
        $result = $stmt->fetch();
        $total = $result['total'];
        return $total;
    }
    function getq($id){
        $conn = connect_to_db();
        $stmt = $conn->query("SELECT commande_produit.quantite as total 
        from commande_produit INNER JOIN produit inner join commande on commande_produit.idproduit=produit.id group by
         commande.idcommande=$id;");
        $result = $stmt->fetch();
        $total = $result['total'];
        return $total;
    }
    public function deleteCommandeInDb($id){
        $conn=connect_to_db();
        $stmt=$conn->query("delete from commande_produit where idcommande=$id");
        $stmt=$conn->query("delete from commande where idcommande=$id;");
        header("location:/commande");
    }
    public function updateCommandeInDb($id){
        $conn=connect_to_db();
        
             $stmt=$conn->query("UPDATE commande SET 
             dateenvoie=Now(),status='envoyé' where idcommande=$id;");
        header("location:/commande");
       
    }
    public function updateCommandeclient($id){
        $conn=connect_to_db();
        
             $stmt=$conn->query("UPDATE commande SET 
             datelivraison=Now(),status='livré' where idcommande=$id;");
        header("location:/commandeclient");
       
    }
}