-- Create the database
CREATE DATABASE IF NOT EXISTS my_database;

-- Use the database
USE my_database;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    role_id INT,
    photo TEXT,
    CONSTRAINT fk_user_role FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Create the roles table
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Create the permissions table
CREATE TABLE IF NOT EXISTS permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Create the role_permissions table to link roles and permissions
CREATE TABLE IF NOT EXISTS role_permissions (
    role_id INT,
    permission_id INT,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

-- Add the role_id column to the users table with a foreign key reference to the roles table
ALTER TABLE users ADD COLUMN role_id INT, 
    ADD CONSTRAINT fk_user_role FOREIGN KEY (role_id) REFERENCES roles(id);

-- Add the photo column to the users table
ALTER TABLE users ADD COLUMN photo TEXT;

-- Insert roles if they don't exist
INSERT INTO roles (name)
SELECT * FROM (SELECT 'admin' UNION SELECT 'editor' UNION SELECT 'user') AS temp
WHERE NOT EXISTS (SELECT 1 FROM roles WHERE name IN ('admin', 'editor', 'user'));

-- Insert permissions if they don't exist
INSERT INTO permissions (name)
SELECT * FROM (SELECT 'create_user' UNION SELECT 'view_user') AS temp
WHERE NOT EXISTS (SELECT 1 FROM permissions WHERE name IN ('create_user', 'view_user'));

-- Insert role_permissions for 'admin' role if they don't exist
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id
FROM roles r
JOIN permissions p ON p.name IN ('create_user', 'view_user')
WHERE r.name = 'admin' AND NOT EXISTS (
    SELECT 1 FROM role_permissions rp
    WHERE rp.role_id = r.id AND rp.permission_id = p.id
);

-- Insert role_permissions for 'user' role if they don't exist
INSERT INTO role_permissions (role_id, permission_id)
SELECT r.id, p.id
FROM roles r
JOIN permissions p ON p.name = 'view_user'
WHERE r.name = 'user' AND NOT EXISTS (
    SELECT 1 FROM role_permissions rp
    WHERE rp.role_id = r.id AND rp.permission_id = p.id
);
