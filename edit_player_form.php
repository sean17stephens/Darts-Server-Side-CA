<?php
require('database.php');
$player_id = filter_input(INPUT_POST, 'player_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM players
          WHERE playerID = :player_id';
$statement = $db->prepare($query);
$statement->bindValue(':player_id', $player_id);
$statement->execute();
$record = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>PHP CRUD</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>PHP CRUD</h1></header>
    <main>
        <h1>Edit record</h1>
        <form action="edit_player.php" method="post" enctype="multipart/form-data"
              id="add_player_form">
            <input type="hidden" name="original_image" value="<?php echo $player['image']; ?>" />
            <input type="hidden" name="player_id"
                   value="<?php echo $player['playerID']; ?>">
            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $player['categoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code"
                   value="<?php echo $player['code']; ?>">
            <br>
            <label>Dart:</label>
            <input type="input" name="dart"
                   value="<?php echo $player['dart']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price"
                   value="<?php echo $player['price']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($record['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $player['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> PHP CRUD, Inc.</p>
    </footer>
</body>
</html>
