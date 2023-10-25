DROP DATABASE IF EXISTS passwords;
CREATE DATABASE passwords DEFAULT CHARACTER SET utf8mb4;
USE passwords;

SET block_encryption_mode = 'aes-256-cbc';
SET @key_str = UNHEX(SHA2('my secret passphrase', 512));
SET @init_vector = RANDOM_BYTES(16);

CREATE TABLE IF NOT EXISTS user (
  domain     VARCHAR(256)   NOT NULL,
  password   VARBINARY(512) NOT NULL
);

INSERT INTO user
VALUES (
  'https://www.weanimalsmedia.org',
  AES_ENCRYPT('weanimals', @key_str, @init_vector)
);

INSERT INTO user
VALUES (
  'https://mercyforanimals.org',
  AES_ENCRYPT('mercy', @key_str, @init_vector)
);

INSERT INTO user
VALUES (
  'https://icij.org',
  AES_ENCRYPT('journalists', @key_str, @init_vector)
);

INSERT INTO user
VALUES (
  'https://www.nytimes.com',
  AES_ENCRYPT('newyork', @key_str, @init_vector)
);
