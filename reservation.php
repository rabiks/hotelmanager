<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Sprawdzenie, czy pokój jest dostępny w wybranym terminie
    if (isRoomAvailable($room_id, $start_date, $end_date)) {
        // Zapisz rezerwację w bazie danych
        $sql = "INSERT INTO reservations (room_id, start_date, end_date) VALUES ('$room_id', '$start_date', '$end_date')";
        if ($conn->query($sql) === TRUE) {
            // Aktualizuj dostępność pokoju w tabeli room_availability
            updateRoomAvailability($room_id, $start_date, $end_date);
            echo "Pokój został zarezerwowany.";
            echo '<form method="get" action="index.php">
                    <button type="submit">Przejdź do strony głównej</button>
                  </form>';
        } else {
            echo "Wystąpił błąd podczas rezerwacji: " . $conn->error;
        }
    } else {
        echo "Ten pokój jest już zarezerwowany w wybranym terminie.";
        echo '<form method="get" action="index.php">
                    <button type="submit">Przejdź do strony głównej</button>
                  </form>';
    }
}

// Funkcja sprawdzająca dostępność pokoju w danym terminie
function isRoomAvailable($room_id, $start_date, $end_date)
{
    global $conn;
    $sql = "SELECT * FROM room_availability WHERE room_id = '$room_id' AND start_date <= '$end_date' AND end_date >= '$start_date'";
    $result = $conn->query($sql);

    return $result->num_rows === 0;
}

// Funkcja aktualizująca dostępność pokoju w tabeli room_availability
function updateRoomAvailability($room_id, $start_date, $end_date)
{
    global $conn;
    $sql = "INSERT INTO room_availability (room_id, start_date, end_date) VALUES ('$room_id', '$start_date', '$end_date')";
    $conn->query($sql);
}
?>
