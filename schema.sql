CREATE DATABASE justdoit
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
USE justdoit;

CREATE TABLE users
(
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email       VARCHAR(128) NOT NULL UNIQUE,
    name        VARCHAR(128) NOT NULL,
    password    VARCHAR(128) NOT NULL,
    INDEX user_email (email)
);

CREATE TABLE projects
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(128),
    user_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id)
);


CREATE TABLE tasks
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    status      TINYINT(1)   DEFAULT 0,
    date_create TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    name        VARCHAR(512) NOT NULL,
    file        VARCHAR(512) DEFAULT NULL,
    finish_date DATE         DEFAULT NULL,
    user_id     INT UNSIGNED NOT NULL,
    project_id  INT          NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (project_id) REFERENCES projects (id)

);



CREATE INDEX project_name ON projects (name);
CREATE INDEX status ON tasks (status);
CREATE INDEX task_i ON tasks (project_id, user_id);
CREATE INDEX user_name ON users (name, email);