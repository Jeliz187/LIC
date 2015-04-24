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
      <h3>Pardon our dust. Under Construction</h3>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-9">
      <p><iframe width="300" height="169" src="http://www.youtube.com/embed/4hwr8YBV1OU" frameborder="0" allowfullscreen style="float:left;margin:0 20px 0 0;"></iframe></p>
      <p><h3>Latinas in Computing</h3> was founded in 2006 as a small
        gathering of Latinas at the Grace Hopper Celebration and has
        grown to over 100 participants from many parts of the world.
        <a href="http://latinasincomputing.org/about/">Learn more &raquo;</a></p>
        <hr style="background-color:#fff;" />
    </div>
  </div>

  <div class="row">
    <div class="col-sm-9">
      <h3><a href="http://latinasincomputing.org/get-involved/">Get Involved!</a> </h3>
      <p>We are always exploring new initiatives and welcoming new members.
        <a href="http://latinasincomputing.org/get-involved/">Learn about how to get involved.</a></p>
    </div>
  </div>

      <div class="row">
        <div class="col-sm-9">
          <h3><a href="http://latinasincomputing.org/achievements/">Achievements</a></h3>
          <p>We are proud to have several prominent Latinas in our community.
            <a href="http://latinasincomputing.org/achievements/">Read more</a>
             about them and their recent accomplishments.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-9">
          <h3><a href="http://latinasincomputing.org/events/">Events</a></h3>
          <p>We participate in a variety of workshops, conferences, and professional associations throughout the year.
            Read more about our <a href="/grace-hopper/ghc-2013/">Grace Hopper Celebration 2013</a> participation and
            our recent involvement in <a href="/events/">other events</a>.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-9">
          <p>At GHC13, we are proud to have our leader Patty Lopez as GHC13 General co-chair and multiple members
            leading activities at the conference. Our reception on Wednesday Oct 2nd is being sponsored by
            MasterCard and executives Sheryl Andrasko and Dana Lorbeng are our invited speakers. On Friday Oct
            4th, our lunch is sponsored by Lockheed Martin once again and our own Jennifer Arguello will lead
            the conversation. If you are attending GHC13, these are the events you should not miss.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-9">
          <h3><a href="http://latinasincomputing.org/members/">Who We Are</a></h3>
          <p>Browse our <a href="http://latinasincomputing.org/members/">members page</a> to learn about many
            of our individual members from a variety of institutions in academia, government and industry.</p>
        </div>
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
