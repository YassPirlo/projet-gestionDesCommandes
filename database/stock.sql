-- Création de la base de données
CREATE DATABASE IF NOT EXISTS pizzeria_eafc;
USE pizzeria_eafc;

-- Création de la table produits
CREATE TABLE produits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  description TEXT,
  prix DECIMAL(10,2) NOT NULL,
  quantite INT NOT NULL,
  categorie VARCHAR(100),
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des produits existants
INSERT INTO produits (nom, description, prix, quantite, categorie) VALUES
('Margherita', 'pizza classique avec sauce tomate, mozzarella et basilic', 12.99, 10, 'pizza'),
('Coca-Cola', 'Boisson gazeuse sucrée', 1.99, 20, 'boisson'),
('Napolitaine', 'pizza avec sauce tomate, mozzarella, anchois et olives', 14.99, 8, 'pizza'),
('Tiramisu', 'dessert italien à base de biscuits imbibés de café, de mascarpone et de cacao', 6.99, 15, 'dessert'),
('Fanta', 'Boisson gazeuse sucrée à l\'orange', 1.99, 25, 'boisson'),
('Quattro Formaggi', 'pizza avec sauce tomate et quatre types de fromage : mozzarella, gorgonzola, parmesan et ricotta', 15.99, 5, 'pizza');
