CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE posts (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    upvotes INT DEFAULT 0,
    FOREIGN KEY (username) REFERENCES users(username)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    postId INT NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username),
    FOREIGN KEY (potId) REFERENCES posts(postId)
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');

INSERT INTO posts (title, username, content) VALUES ('Hello World!', 'admin', 'Hello World!');
