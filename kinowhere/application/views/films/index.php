<h1>All Films</h1>
<a href="/films/create/">Add a Film</a><br>
<?php foreach ($films as $key => $value): ?>
	<p><?php echo $value['title']; ?> | <a href="/films/view/<?php echo $value['slug']; ?>">view</a> | <a href="/films/edit/<?php echo $value['slug']; ?>">Edit</a> | <a href="/films/delete/<?php echo $value['slug']; ?>">Delete</a></p>
<?php endforeach ?>