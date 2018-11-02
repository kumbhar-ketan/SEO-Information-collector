<?php
require __DIR__.'/vendor/autoload.php';
if(isset($_GET['url'])){
  $client = new GuzzleHttp\Client();
  $dom = new \DOMDocument();
  $res = $client->request('GET', $_GET['url'])->getBody()->getContents();
  @$dom->loadHtml($res);
  $data  = '';
  $data .= 'Title: '.$dom->getElementsByTagName('title')->item(0)->textContent.'<br>';
  $heading = $dom->getElementsByTagName('meta');
  foreach($heading as $key => $head){
    if($head->hasAttribute('name')){
      $data .= $head->getAttribute('name').': '.$head->getAttribute('content').'<br>';
    }
  }
  echo $data;
}else{
  echo 'Please pass url parameter';
}
