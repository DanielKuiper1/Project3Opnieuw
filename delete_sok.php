<?php
    require_once('Function.php');

    // Test of er op de delete-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_wzg'])){
        Deletesok($_POST);

        header('Location: Crudpage.php');
    }

    if(isset($_GET['ID'])){  
        echo "Data uit het vorige formulier:<br>";
        // Haal alle info van de betreffende biercode $_GET['biercode']
        $ID = $_GET['ID'];
        $row = Getsok($ID);
    }
   ?>

<html>
    <body>
        <form method="post">
            ID:<input type="" name="biercode" value="<?php echo $row['ID'];?>" readonly><br>
            Naam:<input type="" name="naam" value="<?php echo $row['Naam'];?>" readonly><br> 
            Prijs: <input type="text" name="Prijs" value="<?= $row['Prijs']?>" readonly><br>
            Merk: <input type="text" name="Merk" value="<?= $row['Merk']?>" readonly><br>
            <input type="submit" name="btn_wzg" value="Delete"><br>
        </form>
    </body>
</html>
