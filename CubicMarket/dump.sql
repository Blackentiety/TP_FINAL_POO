CREATE DATABASE IF NOT EXISTS CubicMarket;
USE CubicMarket;

CREATE TABLE IF NOT EXISTS Products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(100) NOT NULL,
    Description TEXT,
    Image VARCHAR(255),
    Price DECIMAL(10, 2) NOT NULL,
    Stock INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Weapons (
    WeaponID INT AUTO_INCREMENT PRIMARY KEY,
    ProductID INT,
    Damage INT NOT NULL,
    weapon_Range INT NOT NULL,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

CREATE TABLE IF NOT EXISTS Ranks (
    RankID INT AUTO_INCREMENT PRIMARY KEY,
    RankName VARCHAR(50) NOT NULL,
    Privileges TEXT NOT NULL,
    ProductID INT,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

CREATE TABLE IF NOT EXISTS User (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    RankID INT,
    user_Role VARCHAR(20) DEFAULT 'ROLE_USER',
    FOREIGN KEY (RankID) REFERENCES Ranks(RankID)
);

CREATE TABLE IF NOT EXISTS Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    ProductID INT,
    OrderDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    TotalAmount INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

INSERT INTO Products (ProductName, Description, Image, Price, Stock) VALUES
('Excalibur Sword', 'A legendary sword of immense power.', 'excalibur.png', 1500.00, 10),
('Dragon Bow', 'A bow crafted from dragon bones.', 'dragon_bow.png', 1200.00, 15),
('Rang', 'Grants access to exclusive items.', 'rank_image.png', 500.00, 100);

INSERT INTO Weapons (ProductID, Damage, weapon_Range) VALUES
(1, 100, 5),
(2, 80, 15);

INSERT INTO Ranks (RankName, Privileges, ProductID) VALUES
('Knight', 'Access to knight-level items and discounts.', 3),
('Archer', 'Access to archer-level items and discounts.', 3);

-- INSERT INTO User (Username, PasswordHash, Email, RankID, Role) VALUES
-- ('hero123', 'hashed_password_1', 'hero123@example.com', 1, 'ROLE_USER'),
-- ('archer456', 'hashed_password_2', 'archer456@example.com', 2, 'ROLE_USER'),
-- ('admin', 'hashed_password_admin', 'admin@example.com', 3, 'ROLE_ADMIN');







