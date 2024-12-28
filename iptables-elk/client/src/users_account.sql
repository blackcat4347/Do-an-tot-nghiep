CREATE DATABASE IF NOT EXISTS my_database;
USE my_database;

CREATE TABLE users_account (
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

INSERT INTO users_account (username, password) VALUES ('user1', 'password1');
INSERT INTO users_account (username, password) VALUES ('user2', 'password2');
INSERT INTO users_account (username, password) VALUES ('user3', 'password3');
INSERT INTO users_account (username, password) VALUES ('user4', 'password4');
INSERT INTO users_account (username, password) VALUES ('user5', 'password5');
