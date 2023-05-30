<?php
require_once 'db.php';

// Pobierz wszystkie pokoje
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);

// Funkcja obliczająca cenę za dany okres
function calculatePrice($start_date, $end_date, $room_id)
{
    global $conn;
    $sql = "SELECT price FROM rooms WHERE id = '$room_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $price_per_day = $row['price'];

    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    $num_days = $interval->days + 1; // Dodaj 1, aby uwzględnić ostatni dzień

    return $price_per_day * $num_days;
}


// Obsługa formularza rezerwacji
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $price = calculatePrice($start_date, $end_date, $room_id);

    // Zapisz rezerwację w bazie danych
    $sql = "INSERT INTO reservations (room_id, start_date, end_date, price) VALUES ('$room_id', '$start_date', '$end_date', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Pokój został zarezerwowany.";
        echo "Cena rezerwacji: $price";

    } else {
        echo "Wystąpił błąd podczas rezerwacji: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Reservation</title>
</head>
<body>
<h1>Hotel Reservation</h1>
<script>
    function calculatePrice() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var roomId = document.querySelector('input[name="room_id"]:checked').value;

        var start = new Date(startDate);
        var end = new Date(endDate);
        var numDays = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;

        var pricePerDay = <?php echo json_encode($rooms); ?>.find(room => room.id === roomId).price;
        var totalPrice = pricePerDay * numDays;

        document.getElementById('price').innerHTML = 'Cena: ' + totalPrice;
    }
</script>
<form action="reservation.php" method="POST">
    <?php foreach ($rooms as $room): ?>
        <div>
            <label for="room-<?php echo $room['id']; ?>">
                <img src="<?php echo $room['image']; ?>" alt="Zdjęcie pokoju" width="200" height="150"><br>
                <input type="radio" name="room_id" id="room-<?php echo $room['id']; ?>" value="<?php echo $room['id']; ?>">
                <?php echo $room['name']; ?>
            </label>
        </div>
    <?php endforeach; ?>
    <br>
    <label for="start_date">Data rozpoczęcia:</label>
    <input type="date" name="start_date" id="start_date" onchange="calculatePrice()">
    <br>
    <label for="end_date">Data zakończenia:</label>
    <input type="date" name="end_date" id="end_date" onchange="calculatePrice()">
    <br>
    <div id="price"></div>
    <br>
    <input type="submit" value="Zarezerwuj">
</form>
</body>
</html>
