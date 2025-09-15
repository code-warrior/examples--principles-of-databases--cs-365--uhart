CREATE TABLE IF NOT EXISTS artist (
  artist_id   SMALLINT     NOT NULL,
  artist_name VARCHAR(128) NOT NULL,
  PRIMARY KEY (artist_id)
);

CREATE TABLE IF NOT EXISTS album (
  artist_id  SMALLINT     NOT NULL,
  album_id   SMALLINT     NOT NULL,
  album_name VARCHAR(128) NOT NULL,
  PRIMARY KEY (artist_id, album_id)
);

CREATE TABLE IF NOT EXISTS track (
  artist_id  SMALLINT     NOT NULL,
  album_id   SMALLINT     NOT NULL,
  track_id   SMALLINT     NOT NULL,
  track_name VARCHAR(128) NOT NULL,
  time       DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (artist_id, album_id, track_id)
);
