CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    username VARCHAR(255) FOREIGN KEY REFERENCES users(username),
    content TEXT NOT NULL,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    upvotes INT DEFAULT 0
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) FOREIGN KEY REFERENCES users(username),
    content TEXT NOT NULL,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    postId INT FOREIGN KEY REFERENCES posts(postId)
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');

INSERT INTO posts (title, username, content) VALUES ('Hello World!', 'admin', 'Hello World!');
