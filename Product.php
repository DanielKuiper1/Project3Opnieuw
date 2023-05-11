    <?php
    require_once('Function.php');

    if(isset($_GET['ID'])){  
        echo "Data uit het vorige formulier:<br>";
        // Haal alle info van de betreffende biercode $_GET['biercode']
        $ID = $_GET['ID'];
        $Article = Getsok($ID);
    }
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="Project3.css" />
  </head>
  <body class="Crudpage">
    <header>
      <ul class="navigation-list">
      <li class="navigation-item"><a href="Homepage.php">Home</a></li>
        <li class="navigation-item"><a href="Webshoppage.php">Products</a></li>
        <li class="navigation-item"><a href="Crudpage.php">CRUD</a></li>
      </ul>
    </header>
    <main>
      <h1><?php echo $Article['Naam'];?></h1>

      <section class="card-container-C card-container">
        <article class="card-crud">

        <form>

        Naam:<input readonly type="" name="Naam" value="<?php echo $Article['Naam'];?>"><br> 
        Merk: <input readonly type="text" name="Merk" value="<?= $Article['Merk']?>"><br>
        Prijs: <input readonly type="text" name="Prijs" value="<?= $Article['Prijs']?>"><br>

        </form>

        </article>
      </section>
    </main>
    <footer>
      <ul class="navigation-list">
        <li class="navigation-item"><a href="#">Terms of Use</a></li>
        <li class="navigation-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </body>
</html>