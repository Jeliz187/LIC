<?php
//Start the Session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="pathway_style.css">
  <style>
  .center {
    margin-left: auto;
    margin-right: auto;
    width: 90%;
  }
  </style>
</head>
  <?php
  //echo "<p> Going In</p>";//debug code $
  $host='earth.cs.utep.edu';
  $user='cs_vosanchez';
  $password='dogK9';
  $database='cs4342team4sp15';
  $connection = mysql_connect($host, $user, $password);
  if(!$connection){
    die('Could not connect: '. mysql_error());
    //echo "<p>Hit a Wall</p>";//debug code %
  }
  mysql_query("use cs4342team4sp15");//changing DB
  $result = mysql_query("SHOW COLUMNS FROM Member");

  if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
  }

  ?>

  <body>
    <?php
      include_once ('navbar.php');
      include_once ('jumbotron.php');
    ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Queries<h1>
        </div><!--column-->
      </div>


      <div class="row">
        <div class="col-md-12">
          <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <label>
              <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
              <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
            </label>
            <?php
              // output all of our Categories
              // for more information see http://codex.wordpress.org/Function_Reference/wp_dropdown_categories
              $swp_cat_dropdown_args = array(
                  'show_option_all'  => __( 'Any Category' ),
                  'name'             => 'swp_category_limiter',
                );
              wp_dropdown_categories( $swp_cat_dropdown_args );
            ?>
            <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
          </form>
        </div><!--column-->
      </div>

    </div><!--CONTAINER-->





    <?php
  //   $forDel;
  //   if(isset($_POST['ve'])){
  //     if (is_array($_POST['ve'])) {
  //       foreach($_POST['ve'] as $value){
  //         //echo $value."+";
  //         $forDel[] = $value;
  //
  //       }
  //     } else {
  //       $value = $_POST['ve'];
  //       //echo $value."|";
  //     }
  //   }
  //
  //
  //   $sqlForDel;
  //   for($x=0; $x<count($forDel);$x++){
  //     //$sql2 = 'DELETE FROM EVENT WHERE EID = "'.$forDel[$x].'";';
  //     //echo $sql2;//debug code $
  //     mysql_query($sql2);
  //     //mysql_query($sql);
  //     $sqlForDel[] = $sql;
  //   //echo $forDel[$x]."|";//debug code $
  // }

    mysqli_close($connection);
    ?>

    <footer class="pathway-footer">
      <p><h4>Built by Pathway Inc.</h4></p>
    </footer>


  </div> <!--Container-->
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</body>
</html>
