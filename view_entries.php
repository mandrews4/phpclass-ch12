<!doctype html>
<html>
<head>
  <title>View the Blog</title>
</head>

<body>
	<h1>My Blog</h1>
	<?php // Script 12.7 - view_entries.php
		require "select_blog.tmpl";
		$query = 'SELECT * FROM entries ORDER BY date_entered DESC';
		if ($r = mysql_query($query, $dbc)) {
			while ($row = mysql_fetch_array($r)) {
				print "<p><h3>" . nl2br($row['title']) . "</h3>" .
						nl2br($row['entry']) . "<br />
						<a href=\"edit_entry.php?id={$row['entry_id']}\">Edit</a><a href=\"delete_entry.php?id={$row['entry_id']}\">Delete</a>
						</p><hr />\n";
			}
		} else { // Query didn't run.
			print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		} // End of query IF.
		mysql_close($dbc);
	?>
</body>
</html>
