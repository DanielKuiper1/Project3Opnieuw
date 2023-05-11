<?php
require_once('Function.php');

// Test of er op de delete-knop is gedrukt 
if (isset($_POST) && isset($_POST['btn_wzg'])) {
  Createsok($_POST);

  header('Location: Crudpage.php');
}

if (isset($_GET['ID'])) {
  echo "Data uit het vorige formulier:<br>";
  // Haal alle info van de betreffende biercode $_GET['biercode']
  $ID = $_GET['ID'];
  $result = Getsok($ID);
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
    <h1>Create
    </h1>
    <section class="card-container-C card-container">
      <article class="card-crud">
        <form method="post" enctype="multipart/form-data">
          Naam:<input type="" name="Naam" value="" ><br>
          Prijs: <input type="text" name="Prijs" value="" ><br>
          Merk: <input type="text" name="Merk" value="" ><br>
          <input type="file" name="IMG" id="fileToUpload"><br>
          <input type="submit" name="btn_wzg" value="Create"><br>
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