<?php
require_once('database.php');
// Get IDs
$player_id = filter_input(INPUT_POST, 'player_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
// Delete the player from the database
if ($player_id != false && $category_id != false) {
    $query = "DELETE FROM players
              WHERE recordID = :player_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':player_id', $player_id);
    $statement->execute();
    $statement->closeCursor();
}
// display the Homepage
include('index.php');
?>
