<?php
require('database.php');
$player_id = filter_input(INPUT_POST, 'player_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM players
          WHERE playerID = :player_id';
$statement = $db->prepare($query);
$statement->bindValue(':player_id', $player_id);
$statement->execute();
$player = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Edit an Existing PLayer</title>
    <link rel="stylesheet" type="text/css" href="./sass/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>Edit Player</h1></header>
    <main>
        <h1>Edit Player</h1>
        <form action="edit_player.php" method="post" enctype="multipart/form-data"
              id="add_player_form">
            <input type="hidden" name="original_image" value="<?php echo $player['image']; ?>" />
            <input type="hidden" name="player_id"
                   value="<?php echo $player['playerID']; ?>">
            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $player['categoryID']; ?>">
            <br>
            <label>Best Finish:</label>
            <input type="input" name="bestfinish" pattern="[A-Za-z]" placeholder="123"
                   value="<?php echo $player['bestfinish']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="dart" pattern="[A-Za-z]" placeholder="Sean Stephens"
                   value="<?php echo $player['dart']; ?>">
            <br>
            <label>Nation:</label>
            <input type="input" name="nation" pattern="[A-Za-z]" placeholder="Ireland"
                   value="<?php echo $player['nation']; ?>">
            <br>
            <label>Winnings:</label>
            <input type="input" name="winning" pattern="[A-Za-z]" placeholder="123000"
                   value="<?php echo $player['winning']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($player['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $player['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sean's Darts Site, Inc.</p>
    </footer>
</body>
</html>
