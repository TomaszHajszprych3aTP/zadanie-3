CREATE DATABASE IF NOT EXISTS your_database_name;

USE your_database_name;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    logins VARCHAR(20),
    pass VARCHAR(30)
);

INSERT INTO
 users
(logins, pass) VALUES
    ('admin', 'test'),
    ('example1', 'pass1'),
    ('ex2ample', 'password');