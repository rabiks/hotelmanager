<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rezerwacje hotelowe</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
<div class="container">
    <?php
    // Pobierz dane o pokojach z bazy danych
    require_once 'db.php';
    $rooms = getRooms();

    // Wyświetl informacje o pokojach
    foreach ($rooms as $room) {
        echo '<div class="room">';
        echo '<img src="' . $room->getImage() . '">';
        echo '<button class="reserve-btn" data-room-id="' . $room->getId() . '">Rezerwuj</button>';
        echo '</div>';
    }
    ?>
</div>

<div id="reservation-popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Wybierz datę rezerwacji</h2>
        <form action="reservation.php" method="POST">
            <input type="hidden" id="room-id" name="room_id" value="">
            <label for="start-date">Data rozpoczęcia rezerwacji:</label>
            <input type="date" id="start-date" name="start_date" required>
            <label for="end-date">Data zakończenia rezerwacji:</label>
            <input type="date" id="end-date" name="end_date" required>
            <button type="submit">Potwierdź rezerwację</button>
        </form>
    </div>
</div>
</body>
</html>
