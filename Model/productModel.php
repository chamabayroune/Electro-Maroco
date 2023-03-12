<?php

class productModel {
    private $posts;
    public function addProductToDb($post,$name){
        $conn=connect_to_db();
if ($_POST["categorie"]!="Catégorie") {
    $p=new productModel();
    $idc=$p->getcat($name)['idcategorie'];
}else{$idc=NULL;}
        $stmt=$conn->query("INSERT INTO produit (image,nom,prix_achat,prix_final,code_barre,reference,
        description,quantite) VALUES ('".$post['photo']."','".$post['name']."',
        '".$post['prixachat']."','".$post['prixfinal']."','".$post['codebare']."',
        '".$post['reference']."','".$post['description']."','".$post['quantite']."') ;");
    }
    public function getcat($name){
      $conn=connect_to_db();
      $stmt=$conn->query("select idcategorie from categorie where namecategorie='$name'");
      $idc=$stmt->fetch();
      return $idc;
    }
    function selectFromDb($element,$id){
        $conn=connect_to_db();
        $stmt=$conn->query("SELECT $element from produit where idProduit=$id");
        $result=$stmt->fetch();
        return $result;
    }
    public function getProductsFromDb($idc,$idu){
        $conn=connect_to_db();
            $stmt=$conn->query("SELECT *FROM produit");
        
        $produit=$stmt->fetchAll();
        return $produit;
    }
    public function getProFromDb($id){
        $conn=connect_to_db();
            $stmt=$conn->query("select * from produit where idProduit=$id;");
        
        $produit=$stmt->fetchAll();
        return $produit;
    }
    public function getPro($id){
        $conn=connect_to_db();
        $stmt=$conn->query("select * from produit where idProduit=$id;");
    
    $produit=$stmt->fetchAll();
    return $produit;
    }
    public function deleteProductInDb($id){
        $conn=connect_to_db();
        $stmt=$conn->query("delete from produit where idProduit= $id;");
    }
    public function updateProduitInDb($post,$id,$bool){
        $conn=connect_to_db();
        if($bool){
             $stmt=$conn->query("UPDATE produit SET photo='".$post['photo']."',namep='".$post['name']."',
             categorie='".$post['categorie']."',prixachat='".$post['prixachat']."',
             prixfinal='".$post['prixfinal']."',reference='".$post['reference']."',
             description='".$post['description']."',quantite=".$post['quantite']." , 
             codebare='".$post['codebare']."' where idProduit=$id;");
        }else{
            $stmt=$conn->query("UPDATE produit SET namep='".$post['name']."',
            categorie='".$post['categorie']."',prixachat='".$post['prixachat']."',
            prixfinal='".$post['prixfinal']."',reference='".$post['reference']."',
            description='".$post['description']."',quantite=".$post['quantite']." , 
            codebare='".$post['codebare']."' where idProduit=$id;");
        }  
    }
}
