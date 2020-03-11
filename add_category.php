<?php
// Get the category data
$dart = $dart = filter_input(INPUT_POST, 'dart');
// Validate inputs
if ($dart == null) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');
    // Add the record to the database
    $query = "INSERT INTO categories (categoryName)
              VALUES (:dart)";
    $statement = $db->prepare($query);
    $statement->bindValue(':dart', $dart);
    $statement->execute();
    $statement->closeCursor();
    // Display the Category List page
    include('category_list.php');
}
?>
