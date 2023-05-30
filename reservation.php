<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $reservation_date = $_POST["reservation_date"];

    // Zapisz rezerwację w bazie danych
    $sql = "INSERT INTO reservations (room_id, reservation_date) VALUES ('$room_id', '$reservation_date')";
    if ($conn->query($sql) === TRUE) {
        echo "Pokój został zarezerwowany.";
    } else {
        echo "Wystąpił błąd podczas rezerwacji. Przekaż podany błąd administratorowi: " . $conn->error;
    }
}
?>