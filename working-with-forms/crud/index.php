<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CRUD Operations via a Web Interface</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header>
      <h1>CRUD Operations via a Web Interface</h1>
    </header>
    <form id="clear-results" method="post"
          action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input id="clear-results__submit-button" type="submit" value="Clear Results">
    </form>

<?php
require_once "includes/php/config.php";
require_once "includes/php/constants.php";
require_once "includes/php/db.php";

$option = (isset($_POST['submitted']) ? $_POST['submitted'] : null);

if ($option != null) {
    switch ($option) {
        case SEARCH:
            if ("" == $_POST['search']) {
                echo '<div id="error">Search query empty. Please try again.</div>' .
                    "\n";
            } else {
                if (NOTHING_FOUND === (search($_POST['search']))) {
                    echo '<div id="error">Nothing found.</div>' . "\n";
                }
            }

            break;

        case UPDATE:
            if ((0 == $_POST['new-attribute']) && ("" == $_POST['pattern'])) {
                echo '<div id="error">One or both fields were empty, ' .
                    'but both must be filled out. Please try again.</div>' . "\n";
            } else {
                update($_POST['current-attribute'], $_POST['new-attribute'],
                    $_POST['query-attribute'], $_POST['pattern']);
            }

            break;

        case INSERT:
            if (("" == $_POST['artist-id']) || ("" == $_POST['artist-name'])) {
                echo '<div id="error">At least one field in your insert request ' .
                     'is empty. Please try again.</div>' . "\n";
            } else {
                insert($_POST['artist-id'],$_POST['artist-name']);
            }

            break;

        case DELETE:
            if (("" == $_POST['current-attribute']) || ("" == $_POST['pattern'])) {
            echo '<div id="error">At least one field in your delete procedure ' .
                 'is empty. Please try again.</div>' . "\n";
        } else {
            delete($_POST['current-attribute'], $_POST['pattern']);
        }

        break;

    }
}

require_once "includes/html/search-form.html";
require_once "includes/html/update-form.html";
require_once "includes/html/insert-form.html";
require_once "includes/html/delete-form.html";
?>
  </body>
</html>
