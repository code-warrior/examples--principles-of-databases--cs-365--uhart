<?php

function search($search) {
    try {
        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $select_query = "SELECT * FROM artist WHERE artist_name LIKE \"%{$search}%\" OR artist_id LIKE \"%{$search}%\"";
        $statement = $db -> prepare($select_query);
        $statement -> execute();

        if (count($statement -> fetchAll()) == 0) {
            return 0;
        } else {
            echo "      <table>\n";
            echo "        <thead>\n";
            echo "          <tr>\n";
            echo "            <th>Artist ID</th>\n";
            echo "            <th>Artist Name</th>\n";
            echo "          </tr>\n";
            echo "        </thead>\n";
            echo "        <tbody>\n";

            // Populate the table with data coming from the database...
            foreach ($db ->query($select_query) as $row) {
                echo "          <tr>\n";
                echo "            <td>" . htmlspecialchars($row[0]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[1]) . "</td>\n";
                echo "          </tr>\n";
            }

            echo "         </tbody>\n";
            echo "      </table>\n";
        }
    } catch( PDOException $e ) {
        echo '<p>The following message was generated by function <code>search</code>:</p>' . "\n";
        echo '<p id="error">' . $e -> getMessage() . '</p>' . "\n";
        echo "<p>There are a few reasons for this. Perhaps the database doesn’t exist or wasn’t mounted. Does the volume/drive containing the database have read and write permissions?</p>\n";
        echo '<p>Click <a href="./">here</a> to go back.</p>';

        exit;
    }
}

function update($current_attribute, $new_attribute, $query_attribute, $pattern) {
    try {
        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $db -> query("UPDATE artist SET {$current_attribute}=\"{$new_attribute}\" WHERE {$query_attribute}=\"{$pattern}\"");
    } catch( PDOException $e ) {
        echo '<p>The following message was generated by function <code>update</code>:</p>' . "\n";
        echo '<p id="error">' . $e -> getMessage() . '</p>' . "\n";

        exit;
    }
}

function insert($artist_id, $artist_name) {
    try {
        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $statement = $db -> prepare("INSERT INTO artist VALUES (:artist_id, :artist_name)");
        $statement -> execute(
            array(
                'artist_id'   => $artist_id,
                'artist_name' => $artist_name
            )
        );
    } catch(PDOException $e) {
        echo '<p>The following message was generated by function <code>insert</code>:</p>' . "\n";
        echo '<p id="error">' . $e -> getMessage() . '</p>' . "\n";

        exit;
    }
}

function delete($current_attribute, $pattern) {
    try {
        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $db -> query("DELETE FROM artist WHERE {$current_attribute}=\"{$pattern}\"");
    } catch(PDOException $e) {
        echo '<p>The following message was generated by function <code>delete</code>:</p>' . "\n";
        echo '<p id="error">' . $e -> getMessage() . '</p>' . "\n";

        exit;
    }
}
