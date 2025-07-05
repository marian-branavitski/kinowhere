<div class="hidden-xs">
  <?php if ($this->dx_auth->is_admin()): ?>
    <a href="/films/admin/all/" class="btn capsule-sm"><i class="glyphicon glyphicon-pencil"></i> Admin</a>
    <div class="row">
      <?php foreach ($film as $key => $value): ?>
        <div class="col-lg-3 saved-block">
          <img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="saved">
          <div class="buttons">
            <a href="/films/view/<?php echo $value['slug']; ?>" class="btn btn-default"><i class="glyphicon glyphicon-share"></i> Open</a>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($film as $key => $value): ?>
        <div class="col-lg-3 saved-block">
          <img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="saved">
          <div class="buttons">
            <a href="/films/view/<?php echo $value['slug']; ?>" class="btn btn-default"><i class="glyphicon glyphicon-share"></i> Open</a>
          </div>
        </div>
      <?php endforeach ?>
    </div>  
  <?php endif ?>  
</div>



<div class="visible-xs">
  <?php if ($this->dx_auth->is_admin()): ?>
    <a href="/films/admin/all/" class="btn capsule-sm"><i class="glyphicon glyphicon-pencil"></i> Admin</a>
    <div class="row">
      <?php foreach ($film as $key => $value): ?>
        <div class="col-lg-3">
          <a href="/films/view/<?php echo $value['slug']; ?>"><img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="img-thumbnail"></a>
        </div>
      <?php endforeach ?>
    </div>
  <?php else: ?>
    <div class="row">
      <?php foreach ($film as $key => $value): ?>
        <div class="col-lg-3">
          <a href="/films/view/<?php echo $value['slug']; ?>"><img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="img-thumbnail"></a>
        </div>
      <?php endforeach ?>
    </div>  
  <?php endif ?>
</div>


<hr>
<div class="capsule-sm">Top <img src="/assets/img/top.png" width="50%" alt="" style="margin-top: -10%;"></div>

<?php foreach ($film_by_rating as $key => $value): ?>
  <div class="row">
    <div class="col-lg-3 col-md-2">
      <img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="img-thumbnail">
    </div>
    <div class="col-md-9">
      <h2 style="margin-bottom: 0; margin-top: 0;"><?php echo $value['title']; ?></h2>
      <img src="assets/img/rating.png" alt="Rating" width="5%"> = <?php echo $value['rating']; ?>/10
      <hr style="margin-top: 0;">
            
      <button class="btn btn-default trailer-btn">Trailer</button><br>
      
      <iframe width="100%" height="310" src="<?php echo $value['trailer']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p class="well well-sm">
        <?php echo $value['description']; ?>
      </p>
      <a href="/films/view/<?php echo $value['slug']; ?>" class="btn btn-default pull-right">Watch</a>
    </div>
  </div>
  <hr class="visible-lg hidden-xs">
<?php endforeach ?>

<div class="margin-8"></div>