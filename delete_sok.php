<?php
require_once('Function.php');

// Test of er op de delete-knop is gedrukt 
if (isset($_POST) && isset($_POST['btn_wzg'])) {
  Deletesok($_POST);

  header('Location: Crudpage.php');
}

if (isset($_GET['ID'])) {
  // Haal alle info van de betreffende biercode $_GET['biercode']
  $ID = $_GET['ID'];
  $row = Getsok($ID);
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
    <h1>Delete
      <?php echo $row['Naam']; ?>
    </h1>
    <section class="card-container-C card-container">
      <article class="card-crud">
        <form method="post">
          ID:<input type="" name="ID" value="<?php echo $row['ID']; ?>" readonly><br>
          Naam:<input type="" name="Naam" value="<?php echo $row['Naam']; ?>" readonly><br>
          Prijs: <input type="text" name="Prijs" value="<?= $row['Prijs'] ?>" readonly><br>
          Merk: <input type="text" name="Merk" value="<?= $row['Merk'] ?>" readonly><br>
          <input type="submit" name="btn_wzg" value="Delete"><br>
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