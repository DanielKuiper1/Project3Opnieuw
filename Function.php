<?php
// auteur: Wigmans
// functie: algemene functies tbv hergebruik
 function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sokkenp3";
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        echo "Connected successfully";
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 
 
 function GetData($table){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode query
    // query: is een prepare en execute in 1 zonder placeholders
    // $result = $conn->query("SELECT * FROM $table")->fetchAll();

    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll();

    return $result;
 }

 function Getsok($ID){
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode query
    // query: is een prepare en execute in 1 zonder placeholders
    // $result = $conn->query("SELECT * FROM $table")->fetchAll();

    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare("SELECT * FROM sok WHERE ID = :ID");
    $query->execute([':ID'=>$ID]);
    $result = $query->fetch();

    return $result;
 }


 function Ovzsokken(){

    // Haal alle bier record uit de tabel 
    $result = GetData("sok");
    
    //print table
    PrintTable($result);
    //PrintTableTest($result);
    
 }

// Function 'PrintTable' print een HTML-table met data uit $result.
function PrintTable($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}

function Crudsokken(){

    // Haal alle bier record uit de tabel 
    $result = GetData("sok");
    
    //print table
    PrintCrudsok($result);
    
 }
function PrintCrudsok($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=white>" . $header . "</th>";   
    }

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        // foreach ($row as $cell) {
            $table .= "<td>" . $row['ID'] . "</td>";
            $table .= "<td>" . $row['Naam'] . "</td>";
            $table .= "<td>" . $row['Prijs'] . "</td>";
            $table .= "<td>" . $row['Merk'] . "</td>";
        // }
        // $table .= "</tr>";
        
        // Wijzig knopje
        $table .= "<td>". 
            "<form method='post' action='update_sok.php?ID=$row[ID]' >       
                    <button name='wzg'>Wzg</button>	 
            </form>" . "</td>";

        // Delete via linkje href
        $table .= '<td><a href="delete_sok.php?ID='.$row["ID"].'">verwijder</a></td>';
        
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}
function Lijstsokken(){

    // Haal alle bier record uit de tabel 
    $result = GetData("sok");
    
    

    //print table
    PrintLijstsok($result);
    
 }

 function PrintLijstsok($result){
    echo '<section class="card-container">';
    $x = 0;
    foreach ($result as $article){
    $x++;
    echo '<article class="card">' 
    . $article["Naam"]
    . '<img>'
    . '</br>' 
    . $article["Merk"] 
    . '</br>' 
    . $article["Prijs"] 
    . "<form method='post' action='Product.php?ID=$article[ID]' >       
    <button name='Bekijk'>Bekijk Product</button>	 
    </form>" 
    . '</article>';
    if ($x > 2){
        echo '</section>';
        echo '<section class="card-container">';
        $x = 0;
    }
    }
    echo '</section>';

 }


function Updatesok($row){
    echo "Update row<br>";

    $conn = ConnectDb();

    $sql = "UPDATE `sok` 
    SET 
    `Naam` = '$row[Naam]', 
    `Prijs` = '$row[Prijs]', 
    `Merk` = '$row[Merk]', 
    WHERE `sok`.`ID` = $row[ID]";
    $query = $conn->prepare($sql);
    $query->execute();
}


function Deletesok($row){
    echo "delete row<br>";

    $conn = ConnectDb();

    $sql = "DELETE 
    FROM sok
    WHERE `sok`.`ID` = $row[ID]";
    $query = $conn->prepare($sql);
    $query->execute();
}