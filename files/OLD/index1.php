<html>

<head>
  <title>
    APACHE PINOT
  </title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div id="divTitle">
      <center>
        <h1>APACHE PINOT</h1>
      </center>
    </div>

    <div id="divQuery">
      <div class="divValueQL">
        <font color="0000FF" size="6">QUERY:</font>
      </div>
      <div class="divValueQR">
        <form name="form" action="" method="get">
          <input type="text" name="query" id="query" placeholder="Insert query here..">
          <button type="submit">QUERY</button>
        </form>
        <?php
        $query = $_GET['query'];
        //echo $query;
        exec('echo "'.$query.'" > query.txt');
        ?>
      </div>
      <div class="divValueQL">
        <font color="0000FF" size="6">RESPONSE:</font>
      </div>
      <div class="divValueQR">
        <div id="responseDiv">
          <?php
          if(file_exists('response.json'))
          {
            $response = file_get_contents('response.json');
            echo $response;
            //exec('rm response.txt');
          }     
          ?></div>
      </div>
    </div>

    <div class="div" id="divLast">
      <?php

      $json = file_get_contents('last.json');

      // Decode the JSON file
      $json_data = json_decode($json, true);

      // Display data
      echo '
      <div class="divValueL">
        <font color="0000FF" size="6">LAST VALUE:</font>
      </div>
      <div class="divValueL">
        <font color="black" size="4">TIMESTAMP:</font><br><br>
        <div id="SERVERL"><font color="0088FF" size="6">' . $json_data[2] . '</font></div>

      </div>
      <div class="divValueL">
        <font color="black" size="4">SENSOR:</font><br><br>
        <div id="SERVERT"><font color="0088FF" size="6">' . $json_data[1] . '</font></div>
      </div>
      <div class="divValueL">
        <font color="black" size="4">VALUE:</font><br><br>
        <div id="SERVERT"><font color="0088FF" size="6">' . $json_data[0] . '</font></div>
      </div>'
      ?>
    </div>

    <div id="divGraph">
      <iframe width="100%" height="400" seamless frameBorder="0" scrolling="no" src="http://192.168.1.50:8088/superset/explore/p/7jX82lqNW9w/?standalone=1&height=400">
      </iframe>
    </div>

    <button id="refresh" onClick="window.location.reload();">Refresh Page</button>

  </div>
</body>

</html>
