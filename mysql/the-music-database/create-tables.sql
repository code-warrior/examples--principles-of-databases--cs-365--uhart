CREATE TABLE artist (
  artist_id   SMALLINT(5)  NOT NULL,
  artist_name VARCHAR(128) NOT NULL,
  PRIMARY KEY (artist_id)
);

CREATE TABLE album (
  artist_id  SMALLINT(5)  NOT NULL,
  album_id   SMALLINT(4)  NOT NULL,
  album_name VARCHAR(128) NOT NULL,
  PRIMARY KEY (artist_id, album_id)
);

CREATE TABLE track (
  artist_id  SMALLINT(5)  NOT NULL,
  album_id   SMALLINT(4)  NOT NULL,
  track_id   SMALLINT(3)  NOT NULL,
  track_name VARCHAR(128) NOT NULL,
  time       DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (artist_id, album_id, track_id)
);
