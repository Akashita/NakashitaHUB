<?php

session_start();
include '../database_handler/bdd.php';

include_once __DIR__ .'/../ICS_parser/iCalEasyReader.php';

//$url = "http://ade6-usmb-ro.grenet.fr/jsp/custom/modules/plannings/direct_cal.jsp?resources=7318&projectId=1&calType=ical&login=iCalExport&password=73rosav&lastDate=2030-08-14";

//Date1 after $Date2
function is_before($dateST1, $dateST2){
  return ($dateST1 <=> $dateST2) == -1;
}

function add_to_sorted_array($array, $event){
  $i = 0;
  $not_placed = true;
  while (($i < count($array)) and $not_placed) {
    if(is_before($event['DTSTART'], $array[$i]['DTSTART'])){
      $not_placed = false;
      array_splice($array, $i, 0, array($event));
    }
    $i++;
  }
  if ($not_placed) {
    array_push($array, $event);
  }
  return $array;
}

function is_UTC($date){
  return substr($date, -1) == 'Z' or substr($date, -1) == 'z';
}

function date_to_local_time($date){
  $year = substr($date, 0, 4);
  $month = substr($date, 4, 2);
  $day = substr($date, 6, 2);
  $hour = substr($date, 9, 2);
  $minute = substr($date, 11, 2);
  $seconde = substr($date, 13, 2);
  $date = new DateTime($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$seconde, new DateTimeZone('UTC'));
  $date->setTimezone(new DateTimeZone('Europe/Paris'));
  return $date->format("Ymd"."\T"."His");
}

function event_to_local_time($event){
  if (is_UTC($event['DTEND'])) {
    $event['DTEND'] = date_to_local_time($event['DTEND']);
  }
  if (is_UTC($event['DTSTART'])){
    $event['DTSTART'] = date_to_local_time($event['DTSTART']);
  }
  return $event;
}

function date_to_string($date){
  $year = substr($date, 0, 4);
  $month = substr($date, 4, 2);
  $day = substr($date, 6, 2);
  $hour = substr($date, 9, 2);
  $minute = substr($date, 11, 2);

  return $day." ".$month." ".$year." à ".$heure."h".$minute;
}

if(isset($_SESSION['ident'])){
  $urls = get_calendar($_SESSION['ident']);

  foreach ($urls as $key => $url) {
    $url = $url['website'];

    $ical = new iCalEasyReader();
    $lines = $ical->load(file_get_contents($url));
    $events = $lines['VEVENT'];

    $sorted_array = array();
    $now = date("Ymd"."\T"."His");
    foreach ($events as $event) {
      $event = event_to_local_time($event);
      if(is_before($now, $event['DTEND'])){
        $sorted_array = add_to_sorted_array($sorted_array, $event);
      }
    }


    for ($i=0; $i < 4; $i++) {
      if(isset($sorted_array[$i])){
        ?>
        <div class="event">
          <div class="event_title">
            <?php echo $sorted_array[$i]['SUMMARY'];?>
          </div>
          <div class="event_start">
            <?php echo date_to_string($sorted_array[$i]['DTSTART']);?>
          </div>
        </div>
        <?php
      }
    }
  }


} else {
  echo 'false';
}


 ?>
