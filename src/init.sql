CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    upvotes INT DEFAULT 0
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');

INSERT INTO posts (title, username, content) VALUES ('Hello World!', 'admin', 'Hello World!');
