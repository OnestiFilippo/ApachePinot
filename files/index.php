<html>
<head>
  <title>
    APACHE PINOT
  </title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <link rel="icon" type="image/png" sizes="32x32" href="pinot32.png">
</head>

<body>
  <div class="container">
    <div id="divTitle">
      <center>
        <b><font color="0000FF" size="6">APACHE PINOT</font></b>
      </center>
    </div>

    <div id="divQuery">
      <div class="divValueQL">
        <font color="0000FF" size="6">QUERY:</font>
      </div>
      <div class="divValueQR">
        <form name="form" action="" method="get">
          <input type="text" name="query" id="query" placeholder="Insert query here..">
          <button type="submit" onclick="">QUERY</button>
        </form>
      </div>
      <div class="divValueQL">
        <font color="0000FF" size="6">RESPONSE:</font>
      </div>
      <div class="divValueQR">
        <?php
          if(isset($_GET['query']))
          {
            $query = $_GET['query'];

            exec('echo "'.$query.'" > query.txt');

            sleep(5);

            if(file_exists('response.json'))
            {
                $response = file_get_contents('response.json');
                echo '<font color="0088FF" size="4">'.$query.'</font>';
                echo '<div id="responseDiv">';
                echo $response;
                echo '</div>';
                exec('rm response.json');
            }
          }
        ?>
        </div>
      </div>
    </div>

    <div class="div" id="divLast">
      <div class="divValueL">
        <font color="0000FF" size="6">LAST VALUE:</font>
      </div>
      <div class="divValueL">
        <font color="black" size="4">DATETIME:</font><br><br>
        <div id="TIMESTAMP"></div>

      </div>
      <div class="divValueL">
        <font color="black" size="4">SENSOR:</font><br><br>
        <div id="SENSOR"></div>
      </div>
      <div class="divValueL">
        <font color="black" size="4">VALUE:</font><br><br>
        <div id="VALUE"></div>
      </div>
    </div>

    <div id="divGraph">
      <iframe width="100%" height="400" seamless frameBorder="0" scrolling="no" src="http://localhost:8088/superset/dashboard/p/axjAdYlBg69?standalone=true">
      </iframe>
    </div>

  </div>
</body>

</html>
