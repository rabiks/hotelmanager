-- Tworzenie tabeli "rooms" przechowującej informacje o pokojach
CREATE TABLE rooms (
id INT PRIMARY KEY AUTO_INCREMENT,
image VARCHAR(255) NOT NULL,
price INT NOT NULL,
name VARCHAR(40) NOT NULL
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

-- nastepnie dodać dane
INSERT INTO `rooms` (`id`, `image` , `price`, `name`) VALUES ('1', 'zdjecie.png' , '100' , 'Domek w gorach');
