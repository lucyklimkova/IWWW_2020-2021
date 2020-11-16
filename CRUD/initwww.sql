CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(60) NOT NULL,
    role VARCHAR(30) NOT NULL
);


INSERT INTO `users` (`id`, `name`, `lastname`, `password`, `email`, `role`) VALUES
(1, 'Lucie', 'Klimkova', '7488e331b8b64e5794da3fa4eb10ad5d', 'lucyklimkova@gmail.com', 'admin'),
(2, 'Petr', 'Novák', '827ccb0eea8a706c4c34a16891f84e7b', 'petr@gmail.com', 'user'),
(3, 'Honza', 'Nový', 'ea705f84cabf8b7e3df0ffdd17a13c65', 'honza@gmail.com', 'user');