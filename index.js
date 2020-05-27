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

  //Send shortcut to database
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

  //Show edit shortcut popup
  $('#shortcut_container').on('click', '.edit', function(){
    let result = $(this).closest('.shortcut').attr('id');
    id_shortcut = result.substring(9);
    $.post('set_get/get_shortcut_json.php',{id_shortcut:id_shortcut},function(data){
      data = JSON.parse(data);
      $('#edit_shortcut_name').val(data.nom);
      $('#edit_shortcut_image').val(data.image);
      $('#edit_shortcut_description').val(data.description);
      $('#edit_shortcut_url').val(data.website);
      $('#edit_keymap').attr('value', data.letter);
    });
    $('#edit_send_shortcut').data('shortcut_id', id_shortcut);
    open_popup('edit_shortcut_container');
  });

  //Delete shortcut
  $('#shortcut_container').on('click', '.delete', function(){
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


  //Send edited shortcut
  $('#edit_send_shortcut').on('click', function(){
    let shortcut_id = $(this).data('shortcut_id');
    let shortcut_name = $('#edit_shortcut_name').val();
    let shortcut_description = $('#edit_shortcut_description').val();
    let shortcut_url = $('#edit_shortcut_url').val();
    let shortcut_image = $('#edit_shortcut_image').val();
    let shortcut_keymap = $('#edit_keymap').attr('value');
    $.post('set_get/edit_shortcut.php',{shortcut_id:shortcut_id, shortcut_name:shortcut_name, shortcut_description:shortcut_description, shortcut_url:shortcut_url, shortcut_image:shortcut_image, shortcut_keymap:shortcut_keymap}, function(data){
      if(data != 'false'){
        shortcut_update();
        close_popup('edit_shortcut_container');
      } else {
        shortcut_update();
        close_popup('edit_shortcut_container');
        show_error("error : ajout du raccourci");
      }
    });
  });

  //Close shortcut popup
  $('#close_edit_shortcut').on('click', function(){
    close_popup('edit_shortcut_container');
  });

  function shortcut_update(){
    $.post('set_get/get_shortcut.php', function(data){
      $('#shortcut_container').html(data);
    });
  }

  //-----------------------------------------------------
  //              WIDGET CONTROLER
  //-----------------------------------------------------

  var actual_widget = 'rss_widget';
  var actual_dot = 'nav_widget_button_rss';
  show_widget(actual_dot, actual_widget);

  $('.nav_widget_button').on('click', function(){
    if($(this).attr('id') != actual_dot){
      hide_widget(actual_dot, actual_widget);
      actual_dot = $(this).attr('id');
      switch (actual_dot) {
        case 'nav_widget_button_weather':
          actual_widget = 'weather_widget';
          break;
        case 'nav_widget_button_rss':
          actual_widget = 'rss_widget';
          break;
        case 'nav_widget_button_calendar':
          actual_widget = 'calendar_widget';
          break;
        default:
      }
      show_widget(actual_dot, actual_widget);
    }
  });

  function show_widget(button, id_widget){
    $('#'+button).addClass("nav_widget_button_dot");
    $('#'+id_widget).css('display', 'block');
    $('#'+id_widget).animate({top: '0px', left: '0px', opacity: '1'}, 200);
  }

  function hide_widget(button, id_widget){
    $('#'+button).removeClass("nav_widget_button_dot");
    $('#'+id_widget).animate({top: '200px', opacity: '0'}, 200, function(){
        $(this).removeAttr('style');
    });
  }

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

  $('#close_edit_rss').on('click', function(){
    close_popup('edit_rss_container');
  });

  function rss_update(){
    $.post('set_get/get_rss.php', function(data){
      $('#article_container').html(data);
    });
  }

  $('#article_container').on('click', '.delete', function(){
    let result = $(this).closest('.rss_theme_container').attr('id');
    id_rss = result.substring(4);
    $.post('set_get/delete_rss.php',{id_rss:id_rss}, function(data){
      if(data == 'false'){
        show_error("error : supression RSS");
      }
    });
    $.when($('#'+result).fadeOut(250)).then(function(){
      rss_update();
    });
  });

  //Show edit shortcut popup
  $('#article_container').on('click', '.edit', function(){
    let result = $(this).closest('.rss_theme_container').attr('id');
    id_rss = result.substring(4);
    $.post('set_get/get_rss_json.php',{id_rss:id_rss},function(data){
      data = JSON.parse(data);
      $('#edit_rss_title').val(data.title);
      $('#edit_rss_link').val(data.website);
      $('#edit_rss_quantity').val(data.howmany);
    });
    $('#edit_send_rss').data('id_rss', id_rss);
    open_popup('edit_rss_container');
  });


  //Send edited shortcut
  $('#edit_send_rss').on('click', function(){
    let rss_id = $(this).data('id_rss');
    let rss_title = $('#edit_rss_title').val();
    let rss_link = $('#edit_rss_link').val();
    let rss_quantity = $('#edit_rss_quantity').val();
    $.post('set_get/edit_rss.php',{rss_id:rss_id, rss_title:rss_title, rss_link:rss_link, rss_quantity:rss_quantity}, function(data){
      if(data != 'false'){
        rss_update();
        close_popup('edit_rss_container');
      } else {
        rss_update();
        close_popup('edit_rss_container');
        show_error("error : modification du feed");
      }
    });
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
      console.log(data);
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
  $('main').css('filter', 'none');
  $('#'+name).fadeOut(250);
  $('#blur').fadeOut(250);
  $('#popup').fadeOut(250);
}

function open_popup(name){
  $('#popup').css('display', 'flex');
  $('main').css('filter', 'blur(2px)');
  $('#'+name).fadeIn(250);
  $('#blur').fadeIn(250);
}
