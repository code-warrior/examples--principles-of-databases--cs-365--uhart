<?php

//if(isset($_POST['submitted'])) {
if(isset($_GET['submitted'])) {
    echo "<div>\n";
    echo "<p><strong><code>\$_GET[first-name]</code>: {$_GET['first-name']}</p>";
    echo "<p><strong><code>\$_GET[e-mail]</code>: {$_GET['e-mail']}</p>";
    echo "<p><strong><code>\$_GET[message]</code>: {$_GET['message']}</p>";
//    echo "<p><strong><code>\$_POST[first-name]</code>: {$_POST['first-name']}</p>";
//    echo "<p><strong><code>\$_POST[e-mail]</code>: {$_POST['e-mail']}</p>";
//    echo "<p><strong><code>\$_POST[message]</code>: {$_POST['message']}</p>";
    echo "<p>Click <a href=\"index.html\">here</a> to go back.</p>";
    echo "</div>\n";
} else {
    echo "<p>The form from index.html was not submitted. Click <a href=\"index.html\">here</a> to go back, or wait 5 seconds.</p>";

    header("Refresh: 5; index.html");
}
