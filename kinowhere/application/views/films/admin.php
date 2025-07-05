<h1>Admin page - Films</h1>
<a href="/films/create" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Add a film</a>
<div class="text-center"><?php echo $pagination; ?></div>
<?php foreach ($films as $key => $value): ?>
	<br>
  <h3><?php echo $value['title']; ?></h3>
	<hr>
	<div class="text-center">
		<a href="/films/edit/<?php echo $value['slug']; ?>" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a>
		<a href="/films/delete/<?php echo $value['slug']; ?>" class="btn btn-default"><i class="glyphicon glyphicon-trash"></i> Delete</a>
		<a href="/films/view/<?php echo $value['slug'] ?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</a>
	</div><br>
    <div class="row">
	    <div class="col-lg-3 col-md-2">
	      <img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="img-thumbnail">
        </div>
	    <div class="col-md-9">
          <table class="table table-striped">
            <tr>
              <th>Rating:</th>
              <td><?php echo $value['rating']; ?>/10 <i class="glyphicon glyphicon-star"></i></td>
            </tr>
            <tr>
              <th>Year:</th>
              <td><?php echo $value['release_date']; ?></td>
            </tr>
            <tr>
              <th>Country:</th>
              <td><?php echo $value['country']; ?></td>
            </tr>
            <tr>
              <th>Time:</th>
              <td><?php echo $value['duration']; ?></td>
            </tr>
            <tr>
              <th>Producer:</th>
              <td><?php echo $value['producer']; ?></td>
            </tr>
          </table>
         </div>
        </div>
        <br>

<?php endforeach ?>
<div class="text-center"><?php echo $pagination; ?></div>