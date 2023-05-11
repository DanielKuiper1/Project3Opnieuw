<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="Project3.css" />
</head>

<body class="Webshoppage">
  <header>
    <ul class="navigation-list">
      <li class="navigation-item"><a href="Homepage.php">Home</a></li>
      <li class="navigation-item"><a href="Webshoppage.php">Products</a></li>
      <li class="navigation-item"><a href="Crudpage.php">CRUD</a></li>
    </ul>
  </header>
  <aside>
  <form method="get" action="">
    <select name="sort">
        <option value="Naam">Sort by Name</option>
        <option value="Prijs">Sort by Price</option>
    </select>
    <select name="direction">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>
    <input type="submit" value="Sort">
</form>
  </aside>
  <main>
    <h1>Producten</h1>
    <?php
    include 'Function.php';
    Lijstsokken();
    ?>
  </main>
  <footer>
    <ul class="navigation-list">
      <li class="navigation-item"><a href="#">Terms of Use</a></li>
      <li class="navigation-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</body>

</html>