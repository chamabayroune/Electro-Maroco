<?php
include_once("header.php");
include_once("navbar.php");
include_once("../controller/ClientController.php")

?>


<section class="clients">
  <div class="table-responsive-md">
      
       
    <table class="table">
      <thead  class="thead-dark">
        <tr>
          <!-- <th scope="titre-table">#</th> -->
          <th scope="col">Clients</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Numéro de Téléphone</th>
          <th scope="col">Ville</th>
          <th scope="col">Adresse</th>
        </tr>
      </thead>
      <tbody>
      
      <?php foreach ($clients as $i => $client) : ?>
        <tr classe="active">
          <th ><?php echo $i + 1 ?></th>
     
          <td><?php echo $client["nom_complet"] ?></td>
          <td><?php echo $client["email"] ?></td>
          <td><?php echo $client["telephone"] ?></td>
          <td><?php echo $client["ville"] ?></td>
          <td><?php echo $client["adresse"]?></td>

        
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

</section>
<?php include_once("footer.php") ?>