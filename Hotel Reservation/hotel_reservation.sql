CREATE DATABASE hotel_reservation;

USE hotel_reservation;

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    room_capacity VARCHAR(50) NOT NULL,
    payment_type VARCHAR(50) NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    num_days INT NOT NULL,
    sub_total DECIMAL(10, 2) NOT NULL,
    additional_charge DECIMAL(10, 2) NOT NULL,
    discount_amount DECIMAL(10, 2) NOT NULL,
    total_bill DECIMAL(10, 2) NOT NULL,
    reservation_time DATETIME NOT NULL
);

CREATE TABLE admin_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin_accounts (username, password)
VALUES ('admin', 'admin123');
