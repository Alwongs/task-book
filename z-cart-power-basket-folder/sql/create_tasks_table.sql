CREATE TABLE tasks 
( 
    `id` int(11) not null primary key auto_increment, 
    `full_name` varchar(255) not null, 
    `email` varchar(255) not null, 
    `task` varchar(255) not null,
    `status` boolean default(0) not null,
    `created_at` varchar(25)
); 

CREATE TABLE users 
( 
    `id` int(11) not null primary key auto_increment, 
    `login` varchar(255) not null UNIQUE, 
    `password` varchar(255) not null, 
    `full_name` varchar(255) not null, 
    `email` varchar(255) not null, 
    `is_admin` boolean default(0) not null
); 


INSERT INTO tasks 
(full_name, email, task, status)
VALUES
('Alex', 'alex@mail.ru ', 'Ввести показания счетчиков', 0),
('Ulyana', 'ulyana@mail.ru ', 'Отправить рисунок', 0),
('Trump', 'trump@mail.ru ', 'Победить на выборах', 0),
('Erdogan', 'erdogan@mail.ru ', 'Продлить сделку', 0),
('Test', 'test@test.test ', 'Продлить сделку', 0);










-- CREATE TABLE tasks 
-- ( 
--     `id` int(11) not null primary key auto_increment, 
--     `full_name` varchar(255) not null, 
--     `email` varchar(255) not null, 
--     `task` varchar(255) not null,
--     `status` boolean default(0) not null,
--     `user_id` int(11) not null, 
--     foreign key (user_id) references users(id)
-- ); 