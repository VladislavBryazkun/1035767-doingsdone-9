CREATE DATABASE justdoit
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;
	USE justdoit;

CREATE TABLE projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name CHAR(50) );

    CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task CHAR(100),
        category CHAR(100),
        status TINYINT DEFAULT 0,
        dt_add TIMESTAMP DEFAULT  CURRENT_TIMESTAMP,
        name CHAR(50) NOT NULL
        );

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        email CHAR(50) NOT NULL,
        name CHAR(50) NOT NULL,
        password CHAR(20) NOT NULL
    );

        CREATE INDEX project_name ON projects(name);
        CREATE INDEX status ON tasks(status);
        CREATE INDEX task_name ON tasks(name);
        CREATE UNIQUE INDEX email ON users(email);
        CREATE INDEX user_name ON users(name);
