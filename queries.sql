INSERT INTO users (name, email, password) VALUES
('Valera', 'valera@mail.ru', 'n_secret'),
('Vasyan', 'vasya@mail.ru', 'secret');


INSERT INTO projects (name, user_id) VALUES ("Входящие", 1), ("Учеба", 2), ("Работа", 1), ("Домашние дела", 1), ("Авто", 1),  ("Велосипед", 2);

INSERT INTO tasks (name, finish_date, project_id, user_id, status) VALUES
('Собеседование в IT компании', '05.05.2019', 2, 1, 1 ),
('Выполнить тестовое задание', '01.07.2019', 3, 1, 0 ),
('Сделать задание первого раздела', '05.05.2019', 4, 1, 1 ),
('Встреча с другом', '05.09.2019', 2, 1, 0 ),
('Купить велисопед', '05.09.2019', 6, 2, 0 ),
('Взять ипотеку', '05.09.2040', 1, 1, 0 ),
('Заказать пиццу', '05.08.2019', 5, 1, 0 );

SELECT id, name FROM projects WHERE user_id = 1;

SELECT p.id, p.name, COUNT(t.project_id) AS Count FROM project p LEFT JOIN task t ON t.project_id = p.id GROUP BY p.id ORDER BY t.project_id ASC;

SELECT id, name FROM tasks WHERE project_id=1;

UPDATE tasks SET status = 1 WHERE id = 2;

UPDATE tasks SET name ='Взял ипотеку' WHERE id = 6;