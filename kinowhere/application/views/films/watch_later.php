<h1 class="text-center"><i class="glyphicon glyphicon-time"></i> Watch Later</h1>
<hr>
<?php if (!$this->dx_auth->is_logged_in()): ?>
  <h3 class="text-center">You must log in first to see your watch later list</h3>
<?php else: ?>
  <div class="row">
    <?php foreach ($watch_later_item as $key => $value): ?>
      <span>
        <div class="col-lg-3 saved-block">
          <img src="<?php echo getFilmById($value['film_id'])->poster; ?>" alt="Poster unavailable" class="saved">
          <div class="buttons">
            <a href="/films/remove_watch_later/<?php echo getFilmById($value['film_id'])->slug; ?>" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i> Remove</a>
            <a href="/films/view/<?php echo getFilmById($value['film_id'])->slug; ?>" class="btn btn-default"><i class="glyphicon glyphicon-share"></i> Open</a>
          </div>
          <p class="text-center"><?php echo getFilmById($value['film_id'])->title; ?></p>
        </div>
      </span>     
    <?php endforeach ?>   
    <?php if (empty($watch_later_item)): ?>
      <h3>All films that you save to watch later will be displayed here</h3>
    <?php else: ?>
      
    <?php endif ?>
  </div>

<?php endif ?>
