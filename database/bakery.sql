CREATE DATABASE IF NOT EXISTS bakery CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bakery;

DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  role VARCHAR(255) NOT NULL DEFAULT 'user',
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE categories (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE products (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  info TEXT NULL,
  image VARCHAR(255) NULL,
  category_id BIGINT UNSIGNED NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  weight VARCHAR(50) NULL,
  is_available TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT products_category_id_foreign FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE contacts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  info VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE posts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  image VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE orders (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'новый',
  delivery_address VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE order_items (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id BIGINT UNSIGNED NOT NULL,
  product_id BIGINT UNSIGNED NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT order_items_order_id_foreign FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  CONSTRAINT order_items_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE reviews (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  product_id BIGINT UNSIGNED NOT NULL,
  text TEXT NOT NULL,
  rating TINYINT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT reviews_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT reviews_product_id_foreign FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (name,email,role,password,created_at,updated_at) VALUES
('Admin','admin@bakery.ru','admin','$2y$12$ggoDVNS2XWFZbaK3nfDdHeOE8LxocyiZywfjgn0YGVFDxhoMVKNlq',NOW(),NOW());

INSERT INTO categories (name,created_at,updated_at) VALUES
('Выпечка',NOW(),NOW()),('Десерты',NOW(),NOW()),('Хлеб',NOW(),NOW());

INSERT INTO contacts (name,info,created_at,updated_at) VALUES
('Адрес','Москва, Нижняя улица, 13',NOW(),NOW()),('Телефон','+7 (912) 011-32-17',NOW(),NOW()),('Email','Bakery@example.com',NOW(),NOW()),('Режим работы','Пн-Вс: 07:00-21:00',NOW(),NOW());

INSERT INTO products (name,info,image,category_id,price,weight,is_available,created_at,updated_at) VALUES
('Сэндвич с курицей','Копченая куриная грудка, сыр моцарелла, помидоры, салат и чесночный соус.','image/1.png',1,499.00,'200 г',1,NOW(),NOW()),
('Круассан сливочный','Воздушный круассан на натуральном сливочном масле.',NULL,1,190.00,'90 г',1,NOW(),NOW()),
('Бородинский хлеб','Ржаной хлеб с кориандром и плотной ароматной корочкой.',NULL,3,120.00,'450 г',1,NOW(),NOW()),
('Чизкейк ванильный','Нежный десерт с творожно-сливочной начинкой.',NULL,2,260.00,'130 г',1,NOW(),NOW());

INSERT INTO posts (title,content,image,created_at,updated_at) VALUES
('Советы по хранению выпечки','Не упаковывайте горячую выпечку сразу: дайте ей остыть. Хлеб храните в бумажном пакете или хлебнице, а десерты с кремом — в холодильнике.',NULL,NOW(),NOW());
