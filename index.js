$(document).ready(function(){
  shortcut_update();
  calendar_update();
  rss_update();
  //-----------------------------------------------------
  //              SHORTCUT CONTROLER
  //-----------------------------------------------------

  //Open shortcut popup
  $('#add_shortcut').on('click', function(){
    open_popup('add_shortcut_container');
  });

  //Close shortcut popup
  $('#close_add_shortcut').on('click', function(){
    close_popup('add_shortcut_container');
  });

  //Keymap listener
  $('#keymap').on('click', function(){
    let message = "Tape sur une touche";
    $('#keymap').attr('value', message);
    $('#keymap').css('background-color', '#ffcccc');
    $(window).keypress(function(e){
      let key = String.fromCharCode(e.which).toUpperCase();
      $('#keymap').attr('value', key);
      $(window).off('keypress'); //Stop listening keypress event
    });
  });

  $('#send_shortcut').on('click', function(){
    let shortcut_name = $('#shortcut_name').val();
    let shortcut_description = $('#shortcut_description').val();
    let shortcut_url = $('#shortcut_url').val();
    let shortcut_image = $('#shortcut_image').val();
    let shortcut_keymap = $('#keymap').attr('value');
    $.post('set_get/send_shortcut.php',{shortcut_name:shortcut_name, shortcut_description:shortcut_description, shortcut_url:shortcut_url, shortcut_image:shortcut_image, shortcut_keymap:shortcut_keymap}, function(data){
      if(data != 'false'){
        shortcut_update();
        close_popup('add_shortcut_container');
        $('#shortcut_name').val('');
        $('#shortcut_image').val('');
        $('#shortcut_description').val('');
        $('#shortcut_url').val('');
        $('#keymap').attr('value', 'keymap');
      } else {
        close_popup('add_shortcut_container');
        show_error("error : ajout du raccourci");
      }
    });
  });

  $('#shortcut_container').on('click', '.delete_shortcut', function(){
    //ajout de confirmation ??
    let result = $(this).closest('.shortcut').attr('id');
    id_shortcut = result.substring(9);
    $.post('set_get/delete_shortcut.php',{id_shortcut:id_shortcut}, function(data){
      if(data == 'false'){
        show_error("error : ajout du raccourci");
      }
    });
    $.when($(this).closest('.shortcut').fadeOut(250)).then(function(){
        shortcut_update();
    });
  });

  function shortcut_update(){
    $.post('set_get/get_shortcut.php', function(data){
      $('#shortcut_container').html(data);
    });
  }

  $('#shortcut_container').on('click', '.edit_shortcut', function(){
    let result = $(this).closest('.shortcut').attr('id');
    id_shortcut = result.substring(9);
    //TODO
  });

  //-----------------------------------------------------
  //              RSS CONTROLER
  //-----------------------------------------------------

  $('#add_rss').on('click', function(){
      open_popup('add_rss_container');
  });

  $('#send_rss').on('click', function(){
    let rss_url = $('#rss_link').val();
    let rss_title = $('#rss_title').val();
    let rss_quantity = $('#rss_quantity').val();
    $.post('set_get/send_rss.php',{rss_url:rss_url, rss_title:rss_title, rss_quantity:rss_quantity}, function(data){
      if(data != 'false'){
        rss_update();
        close_popup('add_rss_container');
        $('#rss_link').val('');
        $('#rss_title').val('');
        $('#rss_quantity').val('');
      } else {
        close_popup('add_rss_container');
        show_error("error : ajout du rss");
      }
    });
  });

  $('#close_add_rss').on('click', function(){
    close_popup('add_rss_container');
  });

  function rss_update(){
    $.post('set_get/get_rss.php', function(data){
      $('#article_container').html(data);
    });
  }

  //-----------------------------------------------------
  //              CALENDAR CONTROLER
  //-----------------------------------------------------

  $('#add_calendar').on('click', function(){
    open_popup('add_calendar_container');
  });

  $('#send_calendar').on('click', function(){
    let calendar_url = $('#calendar_link').val();
    $.post('set_get/send_calendar.php',{calendar_url:calendar_url}, function(data){
      if(data != 'false'){
        calendar_update();
        close_popup('add_calendar_container');
        $('#calendar_link').val('');
      } else {
        close_popup('add_calendar_container');
        show_error("error : ajout du calendrier");
      }
    });
  });

  $('#close_add_calendar').on('click', function(){
    close_popup('add_calendar_container');
  });

  function calendar_update(){
    $.post('set_get/get_calendar.php', function(data){
      $('#event_container').html(data);
    });
  }


  //-----------------------------------------------------
  //              SETTINGS CONTROLER
  //-----------------------------------------------------

  $('#open_settings').on('click', function(){
    open_popup('settings_container');
  });

  $('#close_settings').on('click', function(){
    close_popup('settings_container');
  });


  //-----------------------------------------------------
  //              SHOW ERRORS
  //-----------------------------------------------------

  function show_error(error){
    $('#error_content').html(error);
    $('#error_container').css('display','flex');
    $('#error_container').animate({top: '20px'}, 1000, function(){
      setTimeout(function(){
        $.when($('#error_container').animate({top: '-1000px'}, 1000)).then(function(){
          $('#error_container').css('display','none');
        });
      }, 10000);
    });
    console.log("Erreur " + error);
  }

});

function close_popup(name){
  $('#shortcut_container').css('filter', 'none');
  $('#'+name).fadeOut(250);
  $('#blur').fadeOut(250);
  $('#popup').fadeOut(250);
}

function open_popup(name){
  $('#popup').css('display', 'flex');
  $('#shortcut_container').css('filter', 'blur(2px)');
  $('#'+name).fadeIn(250);
  $('#blur').fadeIn(250);
}
