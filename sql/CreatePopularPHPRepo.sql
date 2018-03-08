CREATE DATABASE repository;
USE repository;

CREATE TABLE repo_details(
  ID int(10) NOT NULL,
  name varchar(255) NOT NULL,
  URL varchar(255) NOT NULL,
  created_date DATETIME NOT NULL,
  last_push_date DATETIME,
  description BLOB,
  stars int(10),
  PRIMARY KEY (id)
);