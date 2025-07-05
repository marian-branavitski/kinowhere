<h1 class="text-center">Edit film: <?php echo $film_title; ?> </h1><br>
<form action="/films/edit/<?php echo $film_slug; ?>" method="post" enctype="multipart/form-data">
	<input type="text" class="form-control input-lg" name="slug" placeholder="Slug" value="<?php echo $film_slug; ?>"><br>
	
	<input type="text" class="form-control input-lg" name="title" placeholder="Name" value="<?php echo $film_title; ?>"><br>
	
	<input type="text" class="form-control input-lg" name="producer" placeholder="Producer" value="<?php echo $film_producer; ?>"><br>
	
	<input type="text" class="form-control input-lg" name="country" placeholder="Country" value="<?php echo $film_country; ?>"><br>
	
	<input type="text" class="form-control input-lg" name="duration" placeholder="Duration" value="<?php echo $film_duration; ?>"><br>
	
	<input type="text" class="form-control input-lg" name="poster" placeholder="Poster link" value="<?php echo $film_poster; ?>"><br>
	
	<input type="text" class="form-control input-lg" name="trailer" placeholder="Trailer link" value="<?php echo $film_trailer; ?>"><br>
	
	<label for="year">Release date</label><br>
	<input id="year" type="number" min="1990" max="2030" class="form-control input-lg" name="release_date" value="<?php echo $film_release_date; ?>"><br>
	
	<label for="rating">Rating</label><br>
	<input id="rating" type="number" min="0" max="10" class="form-control input-lg" name="rating" value="<?php echo $film_rating; ?>"><br>

	<label for="category">Category</label><br>
	<select id="category" name="category_id" class="form-control input-lg" value="<?php echo $film_category; ?>">
		<option value="1">Film</option>
		<option value="2">Series</option>
	</select><br>

	<label for="genre">Genre</label><br>
	<select id="genre" name="genre_id" class="form-control input-lg" value="<?php echo $film_genre; ?>">
		<option value="1">Family</option>
		<option value="2">Children</option>
		<option value="3">Adults</option>
	</select><br>

	<label for="video">You have to select a new video</label><br>
	<input id="video" type="file" name="vid" class="form-control input-lg"><br>

	<input type="date" class="form-control input-lg" name="time_added" value="<?php echo $film_time_added; ?>"><br>

	<textarea name="description" class="form-control input-lg" placeholder="Description" rows="10"><?php echo $film_description; ?></textarea><br>
	<input type="submit" class="btn btn-default" name="submit" value="Save"><br>

</form>
<div class="margin-8"></div>