<?php

$URI = 'http://localhost:8080/waslab02/wall.php';
$resp = file_get_contents($URI);

echo $http_response_header[0], "\n"; // Print the first HTTP response header
$tweets = new SimpleXMLElement($resp);
foreach($tweets as $tweet){
    echo "[tweet #",$tweet['id'],"] ",$tweet->author,": ",$tweet->text," [",$tweet->time,"]\n";
}

$postdata = '<?xml version="1.0"?>
<tweet><author>Test Author</author><text>Test Text</text></tweet>';

$opts = array('http' =>
    array(
        'method'  => 'PUT',
        'header'  => 'Content-type:text/xml',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);
$resp = file_get_contents($URI,false,$context);

echo $resp;


$URIborrar = 'http://localhost:8080/waslab02/wall.php?twid=13';
$borraropts = array('http' =>
    array(
        'method'  => 'DELETE',
        'header'  => 'Content-type:text/xml'
    )
);

$contextborrar = stream_context_create($borraropts);
$respborrar = file_get_contents($URIborrar,false,$contextborrar);

echo $respborrar;

?>

