<!DOCTYPE html>
<html>
<head>
  <title>aTiX Taktzeit</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <meta name="author" content="Ulrich Schwarz">
  <meta name="publisher" content="Ulrich Schwarz">
  <meta name="copyright" content="Ulrich Schwarz">
  <meta name="description" content="process timer">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <script src="timer.jquery.js"></script>
  <script src="moment.js"></script>
  <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <style type="text/css">
    body







    {
      padding-top: 10px;

    }

    .container{




      margin-bottom: 5px;
      margin-top: 100px;
      padding: 2px 2px;
      text-align: right;
      height: 50px;
      color: white;
    }

    .starter-template {



      padding: 2px;
      padding-bottom: 5px;
      text-align: center;
      height: 10px;
      color: white;
    }
    .panel {

      border: 1px solid #e5e5e5;
      text-align: center;
      width: 900px;
      background-color: transparent;
      color: white;
      margin-top: 0px;
      margin-bottom: 0px;
      padding-bottom: 0px;
      padding-top: 0px;
      margin-left: auto;
      margin-right: auto;
    }
    #btn-reset {
      margin-right: 10px;
    }
    #clock
    {
      background-color: transparent;
      height: 30;
      font-size: 150px;

      text-align: center;
      margin-bottom: 0;
    }
    #clock1
    {
      background-color: transparent;
      height: 30;
      font-size: 70px;

      text-align: center;
      margin-bottom: 0;
    }
    #versioninfo
    {
      width: 900px;
      background-color: transparent;
      height: 30;
      font-size: 20px;

      text-align: right;
      margin-top: 0px;
      margin-bottom: 0px;
      padding-bottom: 0px;
      padding-top: 0px;
    }
    #Datum
    {
      width: 900px;
      background-color: transparent;
      height: 30;
      font-size: 20px;
      text-align: right;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 0;
    }
    #Uhrzeit
    {
      width: 900px;
      background-color: transparent;
      height: 30;
      font-size: 30px;
      text-align: right;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 0;
    }
    #KW
    {
      width: 900px;
      background-color: transparent;
      height: 30;
      font-size: 20px;
      text-align: right;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 0px;
    }
  </style>
</head>
<?php
    $host_name  = "db606994136.db.1and1.com";
    $database   = "db606994136";
    $user_name  = "dbo606994136";
    $password   = "F-pa76forme";


    $connect = mysqli_connect($host_name, $user_name, $password, $database);

    if(mysqli_connect_errno())
    {
    echo "Verbindung zum MySQL Server fehlgeschlagen:";
    }
    else
    {
    echo '<p>Verbindung zum MySQL Server erfolgreich aufgebaut.</p>';
    }
    $query = "SELECT * FROM atixtimer";
    if ($result = mysqli_query($connect, $query)){
      $row = mysqli_fetch_array($result);
      print_r($row);
      echo $row;
    }
?>


<body background="blue.jpg">


<div class="container">
  <div class="lead" id="Uhrzeit"></div>
  <div class="lead" id="Datum"></div>
   <div class="lead" id="KW"><h3><span class = "label label-info" id="KWA"></span></h3></div>




  <div class="starter-template">
    <div class="lead" id="versionInfo"></div>
    <p class="lead"<br> </p>
    <div class="panel panel-default" data-toggle="tooltip" data-placement="top" title="">
      <div class="panel-body">

        <div class="lead" id="clock"></div>
        <div class="lead" id="clock1"></div>
        <div class="lead" id="clock3"></div>
        <div class="lead" id="clock4"></div>
        <div class="lead" id="clock5"></div>
        <div class="lead" id="clock6"></div>
        <div class="lead" id="clock7"></div>
        <div class="lead" id="clock8"></div>
        <div class="lead" id="clock9"></div>
        <div class="lead" id="pauseclock"></div>

      </div>
    </div>

    <button type="button" class="btn btn-sm btn-info" id="reset">
      <i class="glyphicon glyphicon-repeat"></i>
      Neustart
    </button>

    <button type="button" class="btn btn-sm btn-warning" id="pause">
      <i class="glyphicon glyphicon-pause"></i>
      Pause
    </button>

    <button type="button" class="btn btn-sm btn-success" id="resume">
      <i class="glyphicon glyphicon-play"></i>
      Resume
    </button>


  </div>
</div>
<script type="text/javascript">





var pausePressed = false;
var pausetime = 0;
var totalpausetime = 0;
var manPause = false;
var autoPause = false;
var start = false;
var KW ="";




var startDate = new Date();
var p1BeginnDate = new Date();
p1BeginnDate.setHours(9);
p1BeginnDate.setMinutes(0);
p1BeginnDate.setSeconds(0);
var p1EndDate = new Date();
p1EndDate.setHours(9);
p1EndDate.setMinutes(20);
p1EndDate.setSeconds(0);

var p2BeginnDate = new Date();
p2BeginnDate.setHours(12);
p2BeginnDate.setMinutes(30);
p2BeginnDate.setSeconds(0);
var p2EndDate = new Date();
p2EndDate.setHours(13);
p2EndDate.setMinutes(0);
p2EndDate.setSeconds(0);

var a1BeginnDate = new Date();
a1BeginnDate.setHours(6);
a1BeginnDate.setMinutes(35);
a1BeginnDate.setSeconds(0);
var a1EndDate = new Date();
a1EndDate.setHours(14);
a1EndDate.setMinutes(30);
a1EndDate.setSeconds(0);



// ab diesem Zeitpunkt wird ein 200 mim Takt in den nächsten Arbeitstag springen
var a1EndDecisionDate= new (Date);
a1EndDecisionDate.setTime(a1EndDate.getTime() - 230 * 60 * 1000);



document.getElementById("clock").innerHTML = "00:00:00";

// Versionsnummer ausgeben
document.getElementById("versionInfo").innerHTML = "ver. 0.1.4";




function KalenderWoche() {
  var KWDatum = new Date();
  var DonnerstagDat = new Date(KWDatum.getTime() + (3-((KWDatum.getDay()+6) % 7)) * 86400000); KWJahr = DonnerstagDat.getFullYear();
  var DonnerstagKW = new Date(new Date(KWJahr,0,4).getTime() + (3-((new Date(KWJahr,0,4).getDay()+6) % 7)) * 86400000);
  KW = Math.floor(1.5 + (DonnerstagDat.getTime() - DonnerstagKW.getTime()) / 86400000/7);
}
 KalenderWoche();
//
function displayTaktende()  {

  manPause = false;
  autoPause = false;


  var now2 = new (Date);
  var p1Referenz = new (Date);
  var p2Referenz = new (Date);
  weekday = startDate.getDay();


  p1Referenz.setHours(p1BeginnDate.getHours() - 3);
  p1Referenz.setMinutes(p1BeginnDate.getMinutes() - 20);
  p1Referenz.setSeconds(0);

  p2Referenz.setHours(p2BeginnDate.getHours() - 3);
  p2Referenz.setMinutes(p2BeginnDate.getMinutes() - 40);
  p2Referenz.setSeconds(0);

  var p1ReferenzString = p1Referenz.toLocaleTimeString();
  var p2ReferenzString = p2Referenz.toLocaleTimeString();
  var startDateString = startDate.toLocaleTimeString();
  var startDateTime = startDateString.split(' ')[0];


    if (now2 > p1BeginnDate && now2 < p1EndDate) {
      startDate.setMinutes(p1EndDate.getMinutes() +50);
      startDate.setHours(p1EndDate.getHours() +4);

      startDate.setSeconds(totalpausetime);
      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;

      isPaused =false;
    }

    else if (now2 < a1BeginnDate || now2 > a1EndDate) {

      startDate.setMinutes(a1BeginnDate.getMinutes() +40);
      startDate.setHours(a1BeginnDate.getHours() +4);
      startDate.setSeconds(0);

      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;


      isPaused = true;


    }

    else if (now2 > p2BeginnDate && now2 < p2EndDate) {

      var newstartDate = new (Date);
      startDate.setMinutes(p2EndDate.getMinutes()+20);
      startDate.setHours(p2EndDate.getHours()+3);

      startDate.setSeconds(totalpausetime);
      var diff = moment(startDate,"HH:mm:ss").diff(moment(a1EndDate,"HH:mm:ss"));
      var d = moment.duration(diff)

      var h = d.hours();
      var m = d.minutes();

      newstartDate.setHours(a1BeginnDate.getHours() + h);
      newstartDate.setMinutes(a1BeginnDate.getMinutes() + m);
      newstartDate.setSeconds(totalpausetime);



      var newstartDateString = newstartDate.toLocaleTimeString();
      var newstartDateTime = newstartDateString.split(" ")[0];

      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+newstartDateTime;


      isPaused =false;


    }

    else if (now2 < p2Referenz && now2 > p1Referenz) {
      startDate.setMinutes(startDate.getMinutes()+20);

      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;

      isPaused =false;
    }

    else if (now2 > p2Referenz && now2 < p1BeginnDate) {
      startDate.setMinutes(startDate.getMinutes()+50);

      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;

      isPaused =false;
    }
    else if (now2 > p1EndDate && now2 < a1EndDecisionDate) {
      startDate.setMinutes(startDate.getMinutes()+30);

      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;

      isPaused =false;
    }
    // Takt geht ueber das Arbeitsende hinaus und beginnt erst nach der Mittagspause
    else if (now2 > p2EndDate) {
      var newstartDate = new (Date);
      var diff = moment(startDate,"HH:mm:ss").diff(moment(a1EndDate,"HH:mm:ss"));

      var d = moment.duration(diff)

      var h = d.hours();
      var m = d.minutes();
      var s = d.seconds();

      newstartDate.setHours(a1BeginnDate.getHours() + h);
      newstartDate.setMinutes(a1BeginnDate.getMinutes() + m);
      newstartDate.setTime(newstartDate.getTime()+ s*1000);

      if (newstartDate.getHours() >= p1BeginnDate.getHours()) {
        newstartDate.setMinutes(newstartDate.getMinutes() +20);
      }

      var newstartDateString = newstartDate.toLocaleTimeString();
      var newstartDateTime = newstartDateString.split(" ")[0];

      var startDateString = startDate.toLocaleTimeString();
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+newstartDateTime;
      startDate = newstartDate;

      isPaused =false;
    }

    // Takt geht ueber das Arbeitsende hinaus und beginnt noch vor der Mittagspause
    else if (now2 > a1EndDecisionDate && now2 < p2BeginnDate) {
      var newstartDate = new (Date);
      var diff = moment(startDate,"HH:mm:ss").diff(moment(a1EndDate,"HH:mm:ss"));

      var d = moment.duration(diff)

      var h = d.hours();
      var m = d.minutes();
      var s = d.seconds();

      newstartDate.setHours(a1BeginnDate.getHours() + h);
      newstartDate.setMinutes(a1BeginnDate.getMinutes() + m + 30);
      newstartDate.setTime(newstartDate.getTime()+ s*1000);

      if (newstartDate.getHours() >= p1BeginnDate.getHours()) {
        newstartDate.setMinutes(newstartDate.getMinutes() +20);
      }

      var newstartDateString = newstartDate.toLocaleTimeString();
      var newstartDateTime = newstartDateString.split(" ")[0];

      var startDateString = startDate.toLocaleTimeString();
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+newstartDateTime;
      startDate = newstartDate;

      isPaused =false;
    }


    else {
      startDate.setSeconds(startDate.getTime() + totalpausetime);
      var startDateString = startDate.toLocaleTimeString()
      var startDateTime = startDateString.split(' ')[0];
      document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;

      isPaused =false;
       }
}

$('#clock').timer({

  duration: '3h20m',
  format: '%H:%M:%S',

  callback: function() {
  $('#clock').timer('pause');
  document.getElementById("clock3").innerHTML = "Taktende";
  //you could have a ajax call here instead
  },
  repeat: false //repeatedly calls the callback you specify
});

// initialisierten Timer gleich pausieren
$('#clock').timer('pause');



$('#pauseclock').timer({

  duration: '7d',
  format: '%H:%M:%S',

  callback: function() {
  $('#pause').timer('pause');

  //you could have a ajax call here instead
  },
  repeat: false //repeatedly calls the callback you specify
});

 // initialisierten Timer gleich pausieren
$('#pauseclock').timer('pause');
// initialisierten Timer gleich pausieren
var div = document.getElementById('pauseclock');
div.style.visibility = 'hidden';




window.setInterval(function(){


  var now = new (Date);
  // wochentag ermitteln
  var weekday = now.getDay();
  var ArrayTage = new Array ("Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag");
  function TagText (Zahl) { return ArrayTage[Zahl]; }
  var Wochentag = TagText(weekday);
  // uhrzeit erzeugen
  var stunde = now.getHours();
  var minute = now.getMinutes();
  var sekunde = now.getSeconds();
  Zeit = ((stunde < 10) ? " 0" : " ") + stunde;
  Zeit += ((minute < 10) ? ":0" : ":") + minute;
  Zeit += ((sekunde < 10) ? ":0" : ":") + sekunde;
  // Zeitaanzeige zusammensetzen : z.B.  Montag 11. Juli 2016
  var nowString = now.toLocaleString();
  var nowDate1 = nowString.split(' ')[0];
  var nowDate2 = nowString.split(' ')[1];
  var nowDate3 = nowString.split(' ')[2];
  var nowDate =  Wochentag+" "+nowDate1+" "+nowDate2+" "+nowDate3;








  if (now >= p1BeginnDate && now <= p1EndDate && weekday < 6)/* <6 Mo-Fr */{
       document.getElementById("clock3").innerHTML = "Frühstückspause";
       $('#clock').timer('pause');

      autoPause = true;
      }
  else if (now >= p2BeginnDate && now <= p2EndDate && weekday < 5)/* <5 Mo-Do */{
      document.getElementById("clock3").innerHTML = "Mittagspause";
      $('#clock').timer('pause');

      autoPause = true;
      }
  else if (manPause === true){
      document.getElementById("clock3").innerHTML = "manuell pausiert";
      $('#clock').timer('pause');

      autoPause = false;
      }
  else if (now <= a1BeginnDate && weekday < 6) {
       document.getElementById("clock3").innerHTML = "(Taktzeiten von 06:35 bis 14:25 Uhr)";
      $('#clock').timer('pause');
       //vor Arbeitsbeginn automatisch starten
       start = true;
       autoPause = true;
       displayTaktende();
      }
  else if (now >= a1EndDate && weekday < 6) {

      document.getElementById("clock3").innerHTML = "(Taktzeiten von 06:35 bis 14:25 Uhr)";
       $('#clock').timer('pause');

       autoPause = true;
      }


  else  {
          if  (start) {
            //nach einer Pause die Infozeile mit Pausenmeldung leeren
            document.getElementById("clock3").innerHTML = "";

            document.getElementById("clock4").innerHTML = "";
            document.getElementById("clock5").innerHTML = "";
            document.getElementById("clock6").innerHTML = "";
                       $('#clock').timer('resume');
                       autopause = false;
                     }
        }

        document.getElementById("clock4").innerHTML = "";

        document.getElementById("Uhrzeit").innerHTML = ""+Zeit+" Uhr";
        document.getElementById("Datum").innerHTML = ""+nowString;
        document.getElementById("KWA").innerHTML = "KW : "+KW;

}, 1000);


$('#reset').click(function() {
  startDate = new (Date);
  startDate.setHours(startDate.getHours() +3 );
  startDate.setMinutes(startDate.getMinutes()+20);

  start = true;
  totalpausetime = 0;
  pausetime = 0;
  $('#pauseclock').timer('reset');
  displayTaktende();
  $('#clock').timer('reset');
  // Pausetimer hidden
  var div = document.getElementById('pauseclock');
  div.style.visibility = 'hidden';
});

$('#pause').click(function() {
  // verhindern das Pausen durch mehrmaliges druecken nicht gezaehlt werden
  if (pausePressed === false && autopause === false) {
    $('#pauseclock').timer('reset');
    pausePressed = true;
  }

  manPause = true;
  // Pausetimer visible
  var div = document.getElementById('pauseclock');
  div.style.visibility = 'visible';

});

$('#resume').click(function() {
  //pausetimer hidden
  var div = document.getElementById('pauseclock');
  div.style.visibility = 'hidden';

  $('#clock').timer('resume');
  $('#pauseclock').timer('pause');
  pausetime = $('#pauseclock').data('seconds');
  if (pausePressed === true && autopause === false) {

    totalpausetime = totalpausetime + pausetime;
  //  document.getElementById("clock6").innerHTML = ""+totalpausetime;
    startDate.setTime(startDate.getTime()+ pausetime*1000);
    var startDateString = startDate.toLocaleTimeString()
    var startDateTime = startDateString.split(' ')[0];
    document.getElementById("clock1").innerHTML = "Taktende: "+startDateTime;
    pausePressed = false;
  }
  document.getElementById("clock3").innerHTML = "";
  pausetime = 0;
  manPause = false;
  document.getElementById("pauseclock").innerHTML = "00:00:00";

});

</script>

<?php include ("db.php"); ?>


</body>
</html>
