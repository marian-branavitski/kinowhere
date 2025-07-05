<?php if ($this->dx_auth->is_admin()): ?>
  <div class="text-center"><h1><?php echo $title; ?></h1> <a href="/films/edit/<?php echo $slug; ?>" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Edit</a></div>
<?php else: ?>
  <h1 class="text-center"><?php echo $title; ?></h1>  
<?php endif ?>

<hr><br>
      <div class="row">
        <div class="col-lg-3 col-md-2">
          <img src="<?php echo $poster; ?>" alt="Poster unavailable" class="img-thumbnail">
        </div>
        <div class="col-md-9">
          <table class="table table-striped">
            <tr>
              <th>Rating:</th>
              <td><?php echo $rating; ?>/10 <i class="glyphicon glyphicon-star"></i></td>
            </tr>
            <tr>
              <th>Year:</th>
              <td><?php echo $release_date; ?></td>
            </tr>
            <tr>
              <th>Country:</th>
              <td><?php echo $country; ?></td>
            </tr>
            <tr>
              <th>Time:</th>
              <td><?php echo $duration; ?></td>
            </tr>
            <tr>
              <th>Producer:</th>
              <td><?php echo $producer; ?></td>
            </tr>
          </table>
          
          
            <!-- <input type="submit" class="btn btn-default" name="save_button" value="Save"> -->
          <div class="row">
          <span>
            <?php if ($is_liked === True): ?>
              <div class="col-lg-3">
                <a href="/films/remove_like/<?php echo $slug; ?>" class="btn btn-success"><i class="glyphicon glyphicon-thumbs-up"></i> You liked it</a>
              </div>
            <?php else: ?>
              <div class="col-lg-2">
                <form action="/films/addlike/<?php echo $slug; ?>" method="post">
                  <button class="btn btn-default" name="like_button"><i class="glyphicon glyphicon-thumbs-up"></i> Like</button>
                </form>    
              </div>
            <?php endif ?>
          </span> <div class="visible-xs"><br></div>

          <span>
            <div class="col-lg-3">
              <form action="/films/dislike/<?php echo $slug; ?>" method="post">
                <button class="btn btn-default"><i class="glyphicon glyphicon-thumbs-down"></i> Dislike</button>
              </form> 
            </div>
          </span> <div class="visible-xs"><br></div>

          <span>
            <?php if ($saved_to_watch_later === True): ?>
              <div class="col-lg-4">
                <a href="/films/remove_watch_later/<?php echo $slug; ?>" class="btn btn-success"><i class="glyphicon glyphicon-time"></i> Saved to watch later</a>
              </div>
            <?php else: ?>
              <div class="col-lg-3">
                <form action="/films/savetowatch/<?php echo $slug; ?>" method="post">
                  <button class="btn btn-default" name="watch_later_button"><i class="glyphicon glyphicon-time"></i> Watch later</button>
                </form>
              </div>
            <?php endif ?>
          </span> <div class="visible-xs"><br></div>
          
          <span>
            <div class="col-lg-3">
              <form action="/films/save/<?php echo $slug; ?>" method="post">  
                <?php if ($is_saved === True): ?>
                  <button class="btn btn-success"><i class="glyphicon glyphicon-saved"></i> Saved</button>
                <?php else: ?>
                  <button class="btn btn-default" name="save_button"><i class="glyphicon glyphicon-save"></i> Save</button>  
                <?php endif ?>
              </form>    
            </div>
          </span>  
          </div>
          
                   
        </div> 
      </div>
      <h2>Description</h2>
      <hr>
      <p class="well">
        <?php echo $description; ?>
      </p>
      <button id="player-btn" class="btn btn-default trailer-btn active" style="border-top-right-radius: 0px;" onclick="show_player()">Player</button><button class="btn btn-default trailer-btn" style="border-top-left-radius: 0px;" onclick="show_trailer()">Trailer</button><br>
      
      <iframe id="trailer" width="80%" height="300" src="<?php echo $trailer; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen hidden></iframe>

      <video id="film" width="80%" height="300" src="<?php echo $vid; ?>" controls></video>

      <script>
        function show_player() {
          document.getElementById('trailer').style.display = 'none';
          document.getElementById('film').style.display = 'block';
          document.getElementById('player-btn').className += "active";  
        }

        function show_trailer() {
          document.getElementById('trailer').style.display = 'block';
          document.getElementById('film').style.display = 'none';
          document.getElementById('player-btn').className += "active";
        }
      </script>

      <h2>Comments</h2>
      <hr>
<!--       <?php print_r($comments); ?>
      <?php echo count($comments); ?> -->
      <?php foreach ($comments as $key => $value): ?>
        <?php if ($this->dx_auth->is_admin()): ?>
          <div class="panel panel-warning">
            <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> <?php echo getUserNameById($value['user_id'])->username; ?> <a href="/films/comment/delete/<?php echo $value['id']; ?>" class="btn btn-warning btn-sm">Remove <i class="glyphicon glyphicon-remove"></i></a></div>
            <div class="panel-body"><?php echo $value['text']; ?></div>
          </div>
        <?php else: ?>
          <div class="panel panel-warning">
            <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> <?php echo getUserNameById($value['user_id'])->username; ?></div>
            <div class="panel-body"><?php echo $value['text']; ?></div>
          </div>  
        <?php endif ?>
        
         
      <?php endforeach ?>
      <?php if (count($comments) == 0): ?>
        <h4>There are no comments yet, be the first one to leave one!</h4>
      <?php else: ?>
        
      <?php endif ?>
       

      <h3>Share your thoughts</h3>
      <?php if ($this->dx_auth->is_logged_in()): ?>
        <form role="submit" action="/films/comment/<?php echo $slug; ?>" method="post" accept-charset="utf-8">
          <textarea name="text" rows="10" class="form-control" placeholder="Share your thoughts"></textarea><br>
          <input type="submit" class="btn btn-default pull-right" value="post"><br>
          <div class="margin-8"></div>
        </form>
      <?php else: ?>
        <h5>Sorry, but you must be loged in to leave the comments!</h5>
        <div class="margin-8"></div>  
      <?php endif ?>
      
