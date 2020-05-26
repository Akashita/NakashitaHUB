<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Nakashita's HUB</title>
    <link rel="stylesheet" href="style/main.css">
  </head>
  <body>
      <nav id="nav_main">
        <div class="slide_container">
          <div class="slide_left_button slide_button" id="add_shortcut">
            <div class="slide_left_text slide_text">NOUVEAU</div>
            <div class="slide_plus_logo slide_logo slide_left_logo"></div>
          </div>
        </div>
        <div class="slide_container">
          <div class="slide_right_button slide_button" id="open_settings">
            <div class="slide_settings_logo slide_logo slide_right_logo"></div>
            <div class="slide_right_text slide_text">SETTINGS</div>
          </div>
        </div>
      </nav>
      <main>
        <section id="shortcuts">
          <article id="shortcut_container">
            <!-- Contain shortcuts (PHP generated) -->
          </article>
        </section>
        <section id="widgets">
          <nav id="nav_widget">
            <div class="nav_widget_button" style="background-image: url(img/ori.jpg)">
              <img src="img/weather.png" class="nav_widget_img" alt="Calendar button">
            </div>
            <div class="nav_widget_button" style="background-image: url(img/background.jpg)">
              <img src="img/rss.png" class="nav_widget_img" alt="Calendar button">
            </div>
            <div class="nav_widget_button" style="background-image: url(img/nc.jpg)">
              <img src="img/calendar.png" class="nav_widget_img" alt="Calendar button">
            </div>
          </nav>
          <article class="widget" id="calendar_widget" style="display: none;">
            <div class="widget_title">
              <div class="slide_left_button slide_button" id="add_calendar">
                <div class="slide_left_text slide_text">NOUVEAU</div>
                <div class="slide_plus_logo slide_logo slide_left_logo"></div>
              </div>
              <span class="title_text">CALENDRIER</span>
              <img class="title_logo" style="width: 22px;" src="img/calendar.png"/>
            </div>
            <div class="widget_container" id="event_container">
                <!-- Contain calendar events (PHP generated) -->
            </div>
          </article>
          <article class="widget" id="rss_widget">
            <div class="widget_title">
              <div class="slide_left_button slide_button" id="add_rss">
                <div class="slide_left_text slide_text">NOUVEAU</div>
                <div class="slide_plus_logo slide_logo slide_left_logo"></div>
              </div>
              <span class="title_text">RSS</span>
              <img class="title_logo" style="width: 18px;" src="img/rss.png"/>
            </div>
            <div class="widget_container" id="article_container">
                <!-- Contain rss feeds (PHP generated) -->
            </div>
          </article>
          <article class="widget" id="weather_widget" style="display: none;">
            <div class="widget_title">
              <div class="slide_left_button slide_button" id="add_calendar">
                <div class="slide_left_text slide_text">NOUVEAU</div>
                <div class="slide_plus_logo slide_logo slide_left_logo"></div>
              </div>
              <span class="title_text">MÉTÉO</span>
              <img class="title_logo" style="width: 25px;" src="img/weather.png"/>
            </div>
            <a class="weatherwidget-io" href="https://forecast7.com/fr/45d565d92/chambery/" data-label_1="Chambéry" data-label_2="Météo" data-font="Open Sans" data-icons="Climacons Animated" data-days="5" data-theme="mountains" data-basecolor="#36393F" data-accent="#2F3136" data-suncolor="#daa623" >Chambéry Météo</a>
            <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
            </script>
          </article>
        </section>
      </main>
      <div id="popup">
        <!-- Blur filter when open popup (default : display none) -->
        <div id="blur"></div>

        <!-- Add shortcut popup (default : display none) -->
        <div id="add_shortcut_container" class="popup_container">
          <div id="add_shortcut_nav" class="popup_nav">
            <div class="slide_left_button slide_button" id="close_add_shortcut">
              <div class="slide_left_text slide_text">FERMER</div>
              <div class="slide_cross_logo slide_logo slide_left_logo"></div>
            </div>
            Shortcut
          </div>
          <div id="add_shortcut_form" class="popup_form">
            <input type="text" id="shortcut_name" placeholder="Nom du raccourci" />
            <input type="text" id="shortcut_description" placeholder="Description" />
            <input type="text" id="shortcut_url" placeholder="URL du site visé" />
            <input type="text" id="shortcut_image" placeholder="URL de l'arrière plan" />
            <input type="button" id="keymap" value="keymap" />
            <input type="button" id="send_shortcut" class="submit" value="Envoyer"/>
          </div>
        </div>

        <!-- Settings popup (default : display none) -->
        <div id="settings_container" class="popup_container">
          <div id="settings_nav" class="popup_nav">
            <div class="slide_left_button slide_button" id="close_settings">
              <div class="slide_left_text slide_text">FERMER</div>
              <div class="slide_cross_logo slide_logo slide_left_logo"></div>
            </div>
            Paramètres
          </div>
          <div id="settings_form" class="popup_form">
            <input type="text" id="" placeholder="Nom du raccourci" />
          </div>
        </div>

        <!-- add_rss popup (default : display none) -->
        <div id="add_rss_container" class="popup_container">
          <div id="add_rss_nav" class="popup_nav">
            <div class="slide_left_button slide_button" id="close_add_rss">
              <div class="slide_left_text slide_text">FERMER</div>
              <div class="slide_cross_logo slide_logo slide_left_logo"></div>
            </div>
            Flux RSS
          </div>
          <div id="rss_form" class="popup_form">
            <input type="text" id="rss_title" placeholder="Titre du flux" />
            <input type="text" id="rss_link" placeholder="Adresse du flux" />
            <div class="input_with_label">
              <label for="quantity">Nombre d'article à afficher</label>
              <input type="number" id="rss_quantity" name="quantity" min="1" max="5">
            </div>
            <input type="button" id="send_rss" class="submit" value="Envoyer"/>
          </div>
        </div>

        <div id="add_calendar_container" class="popup_container">
          <div id="add_calendar_nav" class="popup_nav">
            <div class="slide_left_button slide_button" id="close_add_calendar">
              <div class="slide_left_text slide_text">FERMER</div>
              <div class="slide_cross_logo slide_logo slide_left_logo"></div>
            </div>
            Calendrier
          </div>
          <div id="calendar_form" class="popup_form">
            <input type="text" id="calendar_link" placeholder="Adresse du fichier ICS" />
            <input type="button" id="send_calendar" class="submit" value="Envoyer"/>
          </div>
        </div>
      </div>
      <div id="error_container">
        <div id="error_title">Erreur</div>
        <div id="error_content">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      <script src="jQuery/jQuery-min.js"></script>
      <script type="text/javascript" src="index.js"></script>
  </body>
</html>
