<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Add a New Player</title>
    <link rel="stylesheet" type="text/css" href="./sass/main.css">
</head>
<!-- the body section -->
<body>
    <header><h1>Add a New Player</h1></header>

    <main>
        <h1>Add New Player</h1>
        <form action="add_player.php" method="post" enctype="multipart/form-data"
              id="add_player_form">
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Best Finish:</label>
            <input type="input" name="bestfinish"  placeholder="123">
            <br>

            <label>Name:</label>
            <input type="input" name="dart"  placeholder="Sean Stephens">
            <br>

            <label>Nation:</label>
            <input type="input" name="nation"  placeholder="Ireland">
            <br>

            <label>Winnings:</label>
            <input type="input" name="winning"  placeholder="123000">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <input type="submit" value="Add Player">
            <br>
        </form>
        <p><a href="index.php">Homepage</a></p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sean's Darts Site, Inc.</p>
    </footer>
</body>
</html>
