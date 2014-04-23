CREATE DATABASE IF NOT EXISTS blog;

USE blog;

CREATE TABLE IF NOT EXISTS article (
  id int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  lead varchar(255) NULL,
  body BLOB NULL,
  author int(4) NOT NULL,
  timestamp int(11) NOT NULL,
  modifiedTimestamp int(11) NOT NULL
);

# INSERT INTO article(title,lead,body,author,timestamp,modifiedTimestamp) VALUES ('Title', 'Lead' ,'Body', 1, 1397173860, 1397173985);
# INSERT INTO article(title,lead,body,author,timestamp,modifiedTimestamp) VALUES ('Title 2', 'A longer lead' ,'Some text', 1, 1397174021, 1397174120);

CREATE TABLE IF NOT EXISTS user (
  id int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  author int(1) NOT NULL DEFAULT 0,
  admin int(1) NOT NULL DEFAULT 0
);

# INSERT INTO user(username, email, password, author, admin) VALUES ('peschmae', 'mathias.petermann@gmail.com','', 1, 1);
# INSERT INTO user(username, email, password, author, admin) VALUES ('psmae', 'mathias.petermann@gmail.com','', 0, 0);