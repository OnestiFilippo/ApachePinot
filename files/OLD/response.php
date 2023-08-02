<html>
<head>
  <title>
    QUERY APACHE PINOT
  </title>
</head>
<body>

<?php
    $query = $_GET['query'];

    exec('echo "'.$query.'" > query.txt');
    //exec('python3 query.py "'.$query.'"');

    sleep(5);

    if(file_exists('response.json'))
    {
        $response = file_get_contents('response.json');
        echo $response;
        exec('rm response.json');
    }
?>

</body>
</html>
