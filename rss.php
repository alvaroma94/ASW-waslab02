<?php
require_once("DbHandler.php");
setlocale(LC_TIME,"en_US");
$dbhandler = new DbHandler();

header('Content-type: text/xml; encoding = "UTF-8"');
$resp = new SimpleXMLElement('<rss></rss>');
$resp->addAttribute('version', '2.0');

$resp->addChild('channel');
$resp->channel->addChild('title', 'Wall of Tweets 2 - RSS Version');
$resp->channel->addChild('link', 'http://localhost:8080/waslab02/wall.php');
$resp->channel->addChild('description', 'RSS 2.0 que recupera els tweets penjats a la app "Wall of Tweets 2"');

$tweets = $dbhandler->getTweets();
foreach($tweets as $tweet) {
    $t = $resp->channel->addChild('item');
    $t->addChild('title', $tweet['text']);
    $t->addChild('link','http://localhost:8080/waslab02/wall.php#item_'.$tweet['id']);
    $t->addChild('pubDate', date(DATE_W3C,$tweet['time']));
    $t->addChild('description', 'Aquest es el Tweet número #'.$tweet['id'].' de WoT. Creat per <b>'.$tweet['author'].'</b>. Té <b>'.$tweet['likes'].'</b> likes');
}

echo $resp->asXML();


?>
