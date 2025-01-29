-- Maak de database
CREATE DATABASE domeinwinkel;
USE domeinwinkel;

-- Maak de orders tabel
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    subtotal DECIMAL(10, 2) NOT NULL,   -- Subtotaal (exclusief btw)
    vat DECIMAL(10, 2) NOT NULL,        -- BTW (21%)
    total DECIMAL(10, 2) NOT NULL,      -- Totaal inclusief btw
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Datum en tijd van bestelling
);

-- Maak de order_items tabel
CREATE TABLE order_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,              -- Verwijzing naar de bestelling
    domain_name VARCHAR(255) NOT NULL,  -- Domeinnaam (bijv. 'example.com')
    price DECIMAL(10, 2) NOT NULL,      -- Prijs van het domein
    FOREIGN KEY (order_id) REFERENCES orders(order_id) -- Relatie met orders
);
