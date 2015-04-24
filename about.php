<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="pathway_style.css">

    <?php
    //Start the Session
    session_start();
    ?>

    <?php
        $host='earth.cs.utep.edu';
        $user='cs_vosanchez';
        $password='dogK9';
        $database='cs_vosanchez';
        $connection = mysql_connect($host, $user, $password);
        if(!$connection){
        die('Could not connect: '. mysql_error());
        }
        mysql_close($connection);
        ?>
</head>

<body>

  <?php
  include_once ('navbar.php');
  include_once ('jumbotron.php');
  ?>

<div class="container">


  <div class="row">
    <div class="col-sm-6">
      <h1>ABOUT US</h1>
    </div>
  </div>
  

  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-6">
      A community created by and for the Latinas in computing with a mission of promoting their representation and success in computing-related fields.</em></p>
<p>The <strong>Latinas in Computing (LiC)</strong> community was established with the help of the <a href="http://anitaborg.org/">Anita  Borg Insitute for Women in Technology (ABI) </a>after a Birds of a Feather session at the<a href="http://gracehopper.org/2006/"> 2006 Grace Hopper Conference</a> entitled Latinas in Engineering. There, a group of energized Latinas from industry, government labs and academia discussed the strengths of this growing community and the misconceptions affecting its members.</p>
<p>We talked about our experiences as double minorities, including the self-limiting beliefs that can interfere with our ability to excel and establish ourselves as leaders in computational fields. Given the common experiences discovered by participants in this initial event, <strong>Latinas in Computing</strong> established as its first goal to define key strategies to promote leadership and professional development among the current and next generations of Latinas in technology.</p>
<p>Since then, the <strong>LiC</strong> community has grown to upwards of 150 members and continually attracts new members via conferences and workshops (e.g., <a href="http://gracehopper.org/">Grace Hopper</a>, <a href="http://cahsi.cs.utep.edu/">CAHSI</a>, <a href="http://www.cra-w.org/gradcohort">CRA-W</a>) as well as its presence on <a href="http://www.linkedin.com/groupInvitation?groupID=128729&amp;sharedKey=00B0A74CF92E">LinkedIn</a>, <a href="https://www.facebook.com/groups/latinasincomputing/">Facebook</a>, <a href="http://twitter.com/LatinasInC/">Twitter</a> and <a href="http://www.mentornet.net/lic/">MentorNet</a>, and through professional and community relationships. We have a strong student membership and a number of <a href="../achievements/">distinguished members who have gained recognition</a> for their technical and community contributions.</p>
<p>An active community has allowed us to increase our participation at the Grace Hopper Celebration. We started with one Birds of a Feather session in 2006, to having eleven panels and presentations where <strong>LiC</strong> members are participating in this year. In 2009 we had nine panels, and the <em>&#8220;Speed Mentoring for Latinas&#8221;</em> Birds of a Feather session was the highest rated session.</p>
    </div>
    <div class="col-sm-5"></div>
  </div>


    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</body>

<footer class="pathway-footer">
  <p><h4>Built by Pathway Inc.</h4></p>
</footer>

</html>
