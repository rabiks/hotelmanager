<?php
// Połączenie z bazą danych
// w tym przypadku łączymy się z lokalną bazą XAMPP
$servername = "localhost";
$username = "rabiks-local";
$password = "BardzoTajne!";
$dbname = "rooms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Klasa reprezentująca pokój
class Room
{
    private $id;
    private $image;

    public function __construct($id, $image)
    {
        $this->id = $id;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

}

// Pobierz dane o pokojach z bazy danych i wyświetl je na frontendzie
function getRooms()
{
    global $conn;
    $sql = "SELECT * FROM rooms";
    $result = $conn->query($sql);

    $rooms = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $room = new Room($row['id'], $row['image']);
            array_push($rooms, $room);
        }
    }

    return $rooms;
}
?>