/* mysql -u root -p < setup.sql */

DROP DATABASE IF EXISTS music;

CREATE DATABASE music;

DROP USER IF EXISTS 'music_db_user'@'localhost';

CREATE USER 'music_db_user'@'localhost' IDENTIFIED BY 'f(D2Whiue9d8yD';
GRANT ALL ON music.* TO 'music_db_user'@'localhost';

USE music;

source variables.sql;
source create-tables.sql;
source insert-values.sql;
