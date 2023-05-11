<?php
// auteur: Wigmans
// functie: algemene functies tbv hergebruik
function ConnectDb()
{
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
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}


function GetData($table, $order = NULL, $direction = 'ASC')
{
    // Connect database
    $conn = ConnectDb();

    $sql = "SELECT * FROM $table";
    if ($order) {
        $sql .= " ORDER BY $order $direction";
    }

    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function Getsok($ID)
{
    // Connect database
    $conn = ConnectDb();

    // Select data uit de opgegeven table methode query
    // query: is een prepare en execute in 1 zonder placeholders
    // $result = $conn->query("SELECT * FROM $table")->fetchAll();

    // Select data uit de opgegeven table methode prepare
    $query = $conn->prepare("SELECT * FROM sok WHERE ID = :ID");
    $query->execute([':ID' => $ID]);
    $result = $query->fetch();

    return $result;
}


function Ovzsokken()
{

    // Haal alle bier record uit de tabel 
    $result = GetData("sok");

    //print table
    PrintTable($result);
    //PrintTableTest($result);

}

// Function 'PrintTable' print een HTML-table met data uit $result.
function PrintTable($result)
{
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table border = 1px>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach ($headers as $header) {
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
    $table .= "</table>";

    echo $table;
}

function Crudsokken()
{

    // Haal alle bier record uit de tabel 
    $result = GetData("sok");

    //print table
    PrintCrudsok($result);

}
function PrintCrudsok($result)
{

    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table class='BlackTable'>";

    // Print header table

    // haal de kolommen uit de eerste [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    echo "<form method='post' action='create_sok.php' >       
        <button class='myButton' name='create'>Create</button>	 
         </form>";
    foreach ($headers as $header) {
        $table .= "<th>" . $header . "</th>";
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
        $table .= "<td>" . "-" . "</td>";
        // }
        // $table .= "</tr>";

        // Wijzig knopje
        $table .= "<td>" .
            "<form method='post' action='update_sok.php?ID=$row[ID]' >       
                    <button class='myButton' name='wzg'>Wijzig</button>	 
            </form>" . "</td>";

        // Delete via linkje href
        $table .= "<td>" .
        "<form method='post' action='delete_sok.php?ID=$row[ID]' >       
                <button class='myButton' name='Delete'>Delete</button>	 
        </form>" . "</td>";

        $table .= "</tr>";
    }
    $table .= "</table>";

    echo $table;
}
function Lijstsokken()
{

    // Haal alle bier record uit de tabel 
    $result = GetData("sok");

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
        $result = GetData("sok", $sort, $direction);
    } else {
        $result = GetData("sok");
    }

    //print table
    PrintLijstsok($result);

}

function PrintLijstsok($result)
{
    echo '<section class="card-container">';
    $x = 0;
    foreach ($result as $article) {
        $x++;
        $imageData = base64_encode($article['IMG']);
        $src = 'data:image/png;base64,'.$imageData; // PNG
        echo '<article class="card">'
            . '<img src="'.$src.'" alt="Image" width="200" height="200">'
            . '</br>'
            . $article["Naam"]
            . '</br>'
            . $article["Merk"]
            . '</br>'
            . $article["Prijs"] . '.00 $'
            . "<form method='post' action='Product.php?ID=$article[ID]' >       
    <button name='Bekijk'>Bekijk Product</button>     
    </form>"
            . '</article>';
        if ($x > 2) {
            echo '</section>';
            echo '<section class="card-container">';
            $x = 0;
        }
    }
    echo '</section>';
}

function Createsok($result)
{
    echo "Create row<br>";

    $conn = ConnectDb();

    $imageData = file_get_contents($_FILES['IMG']['tmp_name']);

    $sql = "INSERT INTO sok 
    (Naam, Prijs, Merk, IMG)
    VALUES 
    (:Naam, :Prijs, :Merk, :IMG)";
    $query = $conn->prepare($sql);
    $query->bindParam(':Naam', $result['Naam'], PDO::PARAM_STR);
    $query->bindParam(':Prijs', $result['Prijs'], PDO::PARAM_STR);
    $query->bindParam(':Merk', $result['Merk'], PDO::PARAM_STR);
    $query->bindParam(':IMG', $imageData, PDO::PARAM_LOB); // Use PDO::PARAM_LOB 
    $query->execute();
}
function Updatesok($row)
{
    echo "Update row<br>";

    $conn = ConnectDb();

    $sql = "UPDATE sok 
    SET 
    Naam = :Naam, 
    Prijs = :Prijs, 
    Merk = :Merk
    WHERE sok.ID = :ID";
    $query = $conn->prepare($sql);
    $query->bindParam(':Naam', $row['Naam'], PDO::PARAM_STR);
    $query->bindParam(':Prijs', $row['Prijs'], PDO::PARAM_STR);
    $query->bindParam(':Merk', $row['Merk'], PDO::PARAM_STR);
    $query->bindParam(':ID', $row['ID'], PDO::PARAM_INT);
    $query->execute();
}


// function Deletesok($row)
// {
//     echo "delete row<br>";

//     $conn = ConnectDb();

//     $sql = "DELETE 
//     FROM sok
//     WHERE `sok`.`ID` = :ID";
//     $query = $conn->prepare($sql);
//     $query->execute();
// }
function Deletesok($row)
{
    echo "delete row<br>";

    $conn = ConnectDb();

    $sql = "DELETE 
    FROM sok
    WHERE sok.ID = :ID";
    $query = $conn->prepare($sql);
    // $query->bindParam(':ID', $row['ID'], PDO::PARAM_INT);
    try {
        $query->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}