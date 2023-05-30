<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Zapisz rezerwację w bazie danych
    $sql = "INSERT INTO reservations (room_id, start_date, end_date) VALUES ('$room_id', '$start_date', '$end_date')";
    if ($conn->query($sql) === TRUE) {
        echo "Pokój został zarezerwowany.";
    } else {
        echo "Wystąpił błąd podczas rezerwacji: " . $conn->error;
    }
}
?>