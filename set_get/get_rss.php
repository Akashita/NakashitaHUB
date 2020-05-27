<?php
session_start();
include '../database_handler/bdd.php';
if(isset($_SESSION['ident'])){
  $ident = $_SESSION['ident'];
  $liens = get_rss($ident);
  if ($liens != false) {
    foreach ($liens as $lien) {
      ?>
      <div class="rss_theme_container" id="rss_<?php echo $lien['id_rss'] ?>">
        <div class="rss_title">
          <div class="action_pos">
            <div class="action_container action_rss">
              <div class="action_logo action"></div>
              <div class="delete action"></div>
              <div class="edit action"></div>
            </div>
          </div>
          <?php echo $lien['title'] ?>
        </div>
        <?php
        $url = $lien['website'];
        $feeds = simplexml_load_file($url);

        for ($i=0; $i < $lien['howmany']; $i++) {
          $item = $feeds->channel->item[$i];
          $title = $item->title;
          $link = $item->link;
          ?>
          <div class="rss_article">
            <?php echo $title ?>
            <a href="<?php echo $link; ?>">
              <span class="rss_button"></span>
            </a>
          </div>
          <?php
        }
        ?>
        </div>
        <?php
      }
    }
  }
  ?>
