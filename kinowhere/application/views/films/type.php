<h1 class="category"><?php echo $title; ?> <img src="/assets/img/<?php echo $logo; ?>" alt="" style="width: 7%;"></h1>
<?php if ($this->dx_auth->is_admin()): ?>
  <hr>
  <a href="/films/admin/all/" class="btn capsule-sm"><i class="glyphicon glyphicon-pencil"></i> Admin</a>
<?php else: ?>
  <hr>
<?php endif ?>
<div class="text-center"><?php echo $pagination; ?></div>
<?php foreach ($films_data as $key => $value): ?>
	<div class="row">
    <div class="col-lg-3">
      <img src="<?php echo $value['poster']; ?>" alt="Poster unavailable" class="img-thumbnail">
    </div>
    <div class="col-lg-9">
      <h2 style="margin-top: 0;"><?php echo $value['title']; ?></h2>
      <div class="inline"><img src="assets/img/rating.png" alt="Rating" style="width: 7%;">= <?php echo $value['rating']; ?>/10<p>Year: <?php echo $value['release_date']; ?></p></div>
      <hr style="margin-top: 0;">
      <button class="btn btn-default trailer-btn">Trailer</button>
      <iframe width="100%" height="300" src="<?php echo $value['trailer']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
      <p class="well">
        <?php echo $value['description']; ?>
      </p>
      <a href="/films/view/<?php echo $value['slug']; ?>" class="btn btn-default pull-right">Watch</a><br>
      <div class="margin-8"></div>
    </div>
  </div>

<?php endforeach ?>
<div class="text-center"><?php echo $pagination; ?></div>
<div class="margin-8"></div>