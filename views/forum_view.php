<table class="forum">
   <tr class="header">
      <th class="main">Catégories</th>
      <th class="sub-info">Messages</th>
      <th class="sub-info">Dernier message</th>
   </tr>
   <?php
   while($c = $categories->fetch()) {
      $subcat->execute(array($c['id']));
      $souscategories = '';
      while($sc = $subcat->fetch()) { 
         $souscategories .= '<a href="">'.$sc['nom'].'</a> | ';
      }
      $souscategories = substr($souscategories, 0, -3);
   ?>
   <tr>
      <td class="main">
         <h4><a href=""><?= $c['nom'] ?></a></h4>
         <p>
         <?= $souscategories ?>
         </p>
      </td>
      <td class="sub-info">4083495</td>
      <td class="sub-info">04.12.2015 à 14h52<br />de PrimFX</td>
   </tr>
   <?php } ?>
</table>

12min video 3