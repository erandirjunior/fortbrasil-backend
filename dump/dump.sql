CREATE DATABASE IF NOT EXISTS fortbrasil;

use fortbrasil;

CREATE TABLE IF NOT EXISTS establishment
(
    id         INT AUTO_INCREMENT
        PRIMARY KEY,
    name       VARCHAR(255)                       NOT NULL,
    zip_code   VARCHAR(8)                         NULL,
    number     INT                                NULL,
    street     VARCHAR(255)                       NULL,
    city       VARCHAR(255)                       NULL,
    state      VARCHAR(255)                       NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP NULL,
    deleted_at DATETIME                           NULL,
    updated_at DATETIME                           NULL
);

CREATE TABLE IF NOT EXISTS contact
(
    id               INT AUTO_INCREMENT
        PRIMARY KEY,
    establishment_id INT                                       NOT NULL,
    phone            VARCHAR(11)                               NOT NULL,
    created_at       DATETIME        DEFAULT CURRENT_TIMESTAMP NULL,
    deleted_at       DATETIME                                  NULL,
    updated_at       DATETIME                                  NULL,
    type             ENUM ('1', '2') DEFAULT '1'               NULL,
    CONSTRAINT contact_establishment_id_fk
        FOREIGN KEY (establishment_id) REFERENCES establishment (id)
);

CREATE TABLE IF NOT EXISTS user
(
    id         INT AUTO_INCREMENT
        PRIMARY KEY,
    name       VARCHAR(255)                       NOT NULL,
    email      VARCHAR(255)                       NOT NULL,
    password   VARCHAR(255)                       NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP NULL,
    deleted_at DATETIME                           NULL,
    updated_at DATETIME                           NULL,
    CONSTRAINT user_email_uindex
        UNIQUE (email)
);
