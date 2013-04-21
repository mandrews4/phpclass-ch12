<!doctype html>
<html>
<head>
  <title>Add a Blog Entry</title>
</head>
<body>
	<h1>Add a Blog Entry</h1>
	<?php // Script 12.5 - add_entry.php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require "select_blog.tmpl" ;
		$problem = FALSE;
		if (!empty($_POST['title']) && !empty($_POST['entry'])) {
			$title = mysql_real_escape_string(trim(strip_tags($_POST['title'])), $dbc);
			$entry = mysql_real_escape_string(trim(strip_tags ($_POST['entry'])), $dbc);
		} else {
			print '<p style="color: red;">Please submit both a title and an entry.</p>';
			$problem = TRUE;
		}
		if (!$problem) {
			$query = "INSERT INTO entries(entry_id, title, entry, date_entered) VALUES(0, '$title', '$entry', NOW())";
			if (@mysql_query($query, $dbc)) {
				print '<p>The blog entry has been added!</p>';
			} else {
				print '<p style="color: red;">Could not add the entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
			}
		} // No problem!
		mysql_close($dbc);
	} // End of form submission IF.
	?>

	<form action="add_entry.php" method="post">
	<p>Entry Title: <input type="text" name="title" size="40" maxsize="100" <?php if (isset($_POST['title'])) { print 'value="' . $_POST['title'] . '"'; } ?>/></p>
	<p>Entry Text: <textarea name="entry" cols="40" rows="5"><?php if (isset($_POST['entry'])) { print $_POST['entry']; } ?></textarea></p>
	<input type="submit" name="submit" value="Post This Entry!" />
	</form>

</body>
</html>
