<?php
    echo "<h1>Update Sok</h1>";
    require_once('Function.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_wzg'])){
        Updatesok($_POST);

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
        <br>
        ID:<input readonly type="" name="ID" value="<?php echo $row['ID'];?>"><br>
        Naam:<input  type="" name="Naam" value="<?php echo $row['Naam'];?>"><br> 
        Merk: <input  type="text" name="Merk" value="<?= $row['Merk']?>"><br>
        Prijs: <input  type="text" name="Prijs" value="<?= $row['Prijs']?>"><br>
        <input type="submit" name="btn_wzg" value="Wijzigen"><br>
        </form>
    </body>
</html>
