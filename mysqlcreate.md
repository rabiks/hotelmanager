-- Tworzenie tabeli "rooms" przechowującej informacje o pokojach
CREATE TABLE rooms (
id INT PRIMARY KEY AUTO_INCREMENT,
image VARCHAR(255) NOT NULL
);

-- Tworzenie tabeli "reservations" przechowującej informacje o rezerwacjach
CREATE TABLE reservations (
id INT PRIMARY KEY AUTO_INCREMENT,
room_id INT NOT NULL,
reservation_date DATE NOT NULL,
CONSTRAINT fk_room
FOREIGN KEY (room_id)
REFERENCES rooms(id)
ON DELETE CASCADE
);
