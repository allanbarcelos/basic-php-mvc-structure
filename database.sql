CREATE DATABASE my_database;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE  IF NOT EXISTS  permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE 
);

CREATE TABLE  IF NOT EXISTS  role_permissions (
    role_id INT ,
    permission_id INT,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

ALTER TABLE users ADD COLUMN role_id INT, ADD CONSTRAINT fk_user_role FOREIGN KEY (role_id) REFERENCES roles(id);

ALTER TABLE users ADD COLUMN photo TEXT;

-- 

INSERT INTO roles (name) VALUES ('admin'), ('editor'), ('user');
INSERT INTO permissions (name) VALUES ('create_user'), ('view_user');

INSERT INTO role_permission (role_id, permission_id)
    SELECT r.id, p.id FROM roles r, permissions p WHERE r.name = 'admin';

INSERT INTO role_permission (role_id, permission_id) 
    SELECT r.id, p.id FROM roles r, permission p WHERE r.name = 'user' AND p.name = 'view_user';