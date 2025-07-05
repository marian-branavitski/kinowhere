<form action="/films/create/" method="post" enctype="multipart/form-data">
	<input type="text" class="form-control input-lg" name="slug" placeholder="Slug"><br>
	
	<input type="text" class="form-control input-lg" name="title" placeholder="Name"><br>
	
	<input type="text" class="form-control input-lg" name="producer" placeholder="Producer"><br>
	
	<input type="text" class="form-control input-lg" name="country" placeholder="Country"><br>
	
	<input type="text" class="form-control input-lg" name="duration" placeholder="Duration"><br>
	
	<input type="text" class="form-control input-lg" name="poster" placeholder="Poster link"><br>
	
	<input type="text" class="form-control input-lg" name="trailer" placeholder="Trailer link"><br>
	
	<label for="year">Release date</label><br>
	<input id="year" type="number" min="1990" max="2030" class="form-control input-lg" name="release_date"><br>
	
	<label for="rating">Rating</label><br>
	<input id="rating" type="number" min="0" max="10" class="form-control input-lg" name="rating"><br>

	<label for="category">Category</label><br>
	<select id="category" name="category_id" class="form-control input-lg">
		<option value="1">Film</option>
		<option value="2">Series</option>
	</select><br>

	<label for="genre">Genre</label><br>
	<select id="genre" name="genre_id" class="form-control input-lg">
		<option value="1">Family</option>
		<option value="2">Children</option>
		<option value="3">Adults</option>
	</select><br>

	<label for="video">Video</label><br>
	<input id="video" type="file" name="vid" class="form-control input-lg"><br>

	<input type="date" class="form-control input-lg" name="time_added"><br>

	<textarea name="description" class="form-control input-lg" placeholder="Description" rows="10"></textarea><br>
	<input type="submit" class="btn btn-default" name="post" value="Add"><br>

</form>
<div class="margin-8"></div>