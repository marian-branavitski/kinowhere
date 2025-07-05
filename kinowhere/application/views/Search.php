<h2>Showing results for "<?php echo $q_search; ?>"</h2> 
<hr>
<!-- <?php print_r($watch_later_item); ?>
<hr>
<?php print_r($search_result); ?> -->
<div class="text-center"><?php echo $pagination; ?></div>

<?php foreach ($search_result as $key => $value): ?>
	<div class="row">
    <span>
    <div class="col-lg-3 saved-block" style="margin-right: 0%;">
      <img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="saved">
      <div class="buttons">

        <?php if (check_if_saved($value['id']) === True): ?>
          <a id="saved_btn" href="/films/watch_later/" class="btn btn-success btn-sm hidden-xs"><i class="glyphicon glyphicon-time"></i> Saved for later</a>
        <?php else: ?>
          <form action="/films/savetowatch/<?php echo $value['slug']; ?>" method="post">
            <button class="btn btn-default" name="watch_later_button"><i class="glyphicon glyphicon-time hidden-xs"></i> Watch later</button><br>
          </form>
        <?php endif ?>
        <br><a href="/films/view/<?php echo $value['slug']; ?>" class="btn btn-default hidden-xs"><i class="glyphicon glyphicon-share"></i> Open</a>
      </div>
    </div>
    <div class="col-md-9">
      <h2 style="margin-bottom: 0; margin-top: 0;"><?php echo $value['title']; ?></h2>
      <img src="/assets/img/rating.png" alt="Rating" width="5%"> = <?php echo $value['rating']; ?>/10
      <hr style="margin-top: 0;">
            
      <button class="btn btn-default trailer-btn">Trailer</button><br>
      
      <iframe width="100%" height="310" src="<?php echo $value['trailer']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p class="well well-md">
        <?php echo $value['description']; ?>
      </p>
      <a href="/films/view/<?php echo $value['slug']; ?>/" class="btn btn-default visible-xs"><i class="glyphicon glyphicon-open"></i> View</a>
      <br>
      <?php if (check_if_saved($value['id']) === True): ?>
        <a id="saved_btn" href="/films/watch_later/" class="btn btn-success visible-xs"><i class="glyphicon glyphicon-time"></i> Saved for later</a>
      <?php else: ?>
        <form action="/films/savetowatch/<?php echo $value['slug']; ?>" method="post" class="float-none">
          <button class="btn btn-default visible-xs float-none-btn" name="watch_later_button"><i class="glyphicon glyphicon-time"></i> Watch later</button>
        </form>
      <?php endif ?>
      <hr class="visible-xs">
    </div>
    </span>
  </div>
  <hr class="visible-lg hidden-xs">
<?php endforeach ?>
<div class="text-center"><?php echo $pagination; ?></div>