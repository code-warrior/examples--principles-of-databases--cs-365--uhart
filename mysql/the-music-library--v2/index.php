<?php
require "includes/db.php";

const MELVINS = 4;

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Working with a XAMP Stack Using a Music Database</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&family=IBM+Plex+Sans:ital,wght@100;200;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Working with a XAMP Stack Using a Music Database</h1>
  </header>
  <main>
    <section>
      <h2>Check if a Value Exists in a Table’s Attribute</h2>
      <p><code>function valueExistsInAttribute($value, $attribute, $table)</code></p>
      <hr>
      <p><strong class="database-query">Query</strong>: Is <i>Dysnomia</i> in my record collection?</p>
      <p><strong class="database-result">Result</strong>:
        <?php
            if(valueExistsInAttribute("Dysnomia", "album_name", "album")) {
                echo "According to our database, <i>Dysnomia</i> is in my record collection.";
            } else {
                echo "<strong><i>Dsynomia</i> was <em>not</em> found in your music database. What a shame?</strong>";
            }
        ?>
      </p>
    </section>
    <section>
      <h2>Retrieve all Attribute Values in a Table</h2>
      <p><code>function getAttributeFromTable($attribute, $table)</code></p>
      <hr>
      <p><strong class="database-query">Query</strong>: Show me all the albums in my record collection?</p>
      <p><strong class="database-result">Result</strong>:</p>
      <ul>
        <?php getAttributeFromTable('album_name', 'album'); ?>
      </ul>
    </section>
    <section>
      <h2>Retrieve the First Value From a Relation Should a Query Match a Pattern</h2>
      <p><code>function getValue($value, $table, $query, $pattern)</code></p>
      <hr>
      <p><strong class="database-query">Query</strong>: I have so many albums. Do I own The Melvins’ <i>Houdini</i>?</p>
      <p><strong class="database-result">Result</strong>:
        <?php
            $albumName = getValue("album_name", "album", "artist_id", MELVINS);

            if(strcmp($albumName, "Houdini") == 0) {
                echo "Indeed, <i>{$albumName}</i> is in my collection";
            } else {
                echo "<i>{$albumName}</i> is not in your collection. Get it, now!";
            }
        ?>
      </p>
    </section>
    <section>
      <h2>Update an Attribute</h2>
      <p><code>function updateAttribute($table, $current_attribute, $new_attribute, $query_attribute, $pattern)</code></p>
      <hr>
      <p><strong class="database-query">Query</strong>: Warpaint’s <i>Heads Up</i> should not be in all caps. Let’s change it to title case.</p>
      <p><strong class="database-result">Result</strong>:
        <?php
            updateAttribute("album", "album_name", "Heads Up", "album_name", "HEADS UP");
        ?>
      </p>
      <ul>
        <?php getAttributeFromTable('album_name', 'album'); ?>
      </ul>
    </section>
  </main>
</body>
</html>
