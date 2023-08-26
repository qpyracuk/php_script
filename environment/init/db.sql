-- Инициализация исходной таблицы
CREATE TABLE src (
    id INT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
    campaign VARCHAR(99) NOT NULL,
    puid VARCHAR(99) NOT NULL,
    token VARCHAR(99) NOT NULL,
    date DATETIME NULL,
    unwrap BIT NOT NULL DEFAULT 0
);


-- Инициализация результирующей таблицы
CREATE TABLE res (
    id INT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
    Campaign VARCHAR(99) NOT NULL,
    Puid VARCHAR(99) NOT NULL,
    Token VARCHAR(99) NOT NULL,
    Encryptedkey VARCHAR(200) NULL
);

