<h1 class="text-center"><i class="glyphicon glyphicon-save"></i> Library</h1>
<hr>
<?php if (!$this->dx_auth->is_logged_in()): ?>
  <h3 class="text-center">You must log in first to see films in your library</h3>
<?php else: ?>
  <div class="row">
    <?php foreach ($library_item as $key => $value): ?>
      <span>
        <div class="col-lg-3 saved-block">
          <img src="<?php echo getFilmById($value['film_id'])->poster; ?>" alt="Poster unavailable" class="saved">
          <div class="buttons">
            <a href="/films/view/<?php echo getFilmById($value['film_id'])->slug; ?>" class="btn btn-default"><i class="glyphicon glyphicon-share"></i> Open</a>
            <a href="/films/download/<?php echo getFilmById($value['film_id'])->slug; ?>" class="btn btn-default"><i class="glyphicon glyphicon-download-alt"></i> Download</a>
          </div>
          <p class="text-center"><?php echo getFilmById($value['film_id'])->title; ?></p>
        </div>
      </span>            
    <?php endforeach ?>        
    <?php if (empty($library_item)): ?>
      <h3>All films that you save will be displayed here, ready for you to download</h3>
    <?php else: ?>

    <?php endif ?>
  </div>  
<?php endif ?>
