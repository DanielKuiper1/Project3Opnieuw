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
      <p>sidebar</p>
    </aside>
    <main>
      <h1>Producten</h1>
      <?php
        include 'Function.php';
        Lijstsokken();
      ?>
      <!-- <section class="card-container">
        <article class="card">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem neque
          veritatis, itaque rerum eaque facilis odio repellat quasi. Eius
          mollitia perspiciatis a enim minus sapiente impedit aliquid iusto
          porro debitis.
        </article>
        <article class="card">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem neque
            veritatis, itaque rerum eaque facilis odio repellat quasi. Eius
            mollitia perspiciatis a enim minus sapiente impedit aliquid iusto
            porro debitis.
          </article>
          <article class="card">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem neque
            veritatis, itaque rerum eaque facilis odio repellat quasi. Eius
            mollitia perspiciatis a enim minus sapiente impedit aliquid iusto
            porro debitis.
          </article>
      </section> -->
    </main>
    <footer>
      <ul class="navigation-list">
        <li class="navigation-item"><a href="#">Terms of Use</a></li>
        <li class="navigation-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </body>
</html>
