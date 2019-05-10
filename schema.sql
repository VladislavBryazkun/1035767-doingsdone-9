CREATE DATABASE justdoit
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;
	USE justdoit;

CREATE TABLE projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(128)
        );

    CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(128),
        category VARCHAR(128),
        status TINYINT DEFAULT 0,
        dt_add TIMESTAMP DEFAULT  CURRENT_TIMESTAMP,
        name VARCHAR(128) NOT NULL,
        file TEXT
         );

    CREATE TABLE users (
        id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        email       VARCHAR(128) NOT NULL UNIQUE,
        name   VARCHAR(128) NOT NULL,
        password    VARCHAR(128) NOT NULL,
        INDEX user_email (email)
        );

            CREATE INDEX project_name ON projects(name);
            CREATE INDEX status ON tasks(status);
            CREATE INDEX task_name ON tasks(name);
            CREATE INDEX user_name ON users(name);