<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}
// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];
// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();
// Get records for selected category
$queryPlayers = "SELECT * FROM players
WHERE categoryID = :category_id
ORDER BY playerID";
$statement3 = $db->prepare($queryPlayers);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$players = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
<title> Darts Players</title>
<link rel="stylesheet" type="text/css" href="./sass/main.css">
</head>
<!-- the body section -->
<body>
<header><h1>Darts Players</h1></header>
<main>
<h1>Player List</h1>
<aside>
<!-- display a list of categories in the sidebar-->
<h2>Leagues</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of records from the database -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<th>Image</th>
<th>Name</th>
<th>Best Finish</th>
<th>Winnings</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($players as $player) : ?>
<tr>
<td><img src="image_uploads/<?php echo $player['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $player['dart']; ?></td>
<td><?php echo $player['bestfinish']; ?></td>
<td><?php echo $player['winning']; ?></td>
<td><form action="delete_player.php" method="post"
id="delete_player_form">
<input type="hidden" name="player_id"
value="<?php echo $player['playerID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $player['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_player_form.php" method="post"
id="delete_player_form">
<input type="hidden" name="player_id"
value="<?php echo $player['playerID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $player['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_player_form.php">Add Player</a></p>
<p><a href="category_list.php">Edit Leagues</a></p>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> Sean's Darts Site, Inc.</p>
</footer>
</body>
</html>
