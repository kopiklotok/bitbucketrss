<?php
if(isset($_GET['username']) && isset($_GET['repo']) && isset($_GET['token'])){

  header('Content-Type: application/json');
  
  $username = $_GET['username'];
  $repo     = $_GET['repo'];
  $token    = $_GET['token'];

  require_once 'src/Feed.php';
  $rss = Feed::loadRss('https://bitbucket.org/'.$username.'/'.$repo.'/rss?token='.$token);

  $data= [];
  foreach ($rss->item as $item){

  	$domknt = new domDocument();
  	@$domknt->loadHTML(htmlspecialchars_decode($item->description));
  	$dodknt = $domknt->getElementsByTagName('a');
  	$file 	= '';
  	$file 	= [];
  	$i 			= 1;
  	$fg 		= [];
  	foreach($dodknt as $c){
  	  if($i<=5){
  			$file[] = trim($c->nodeValue);
  		}
  		$fg[] = $c;
  	$i++;}

  	$data[] = [
  		'title' => trim($item->title),
  		'commit'=> basename($item->link),
  		'link' 	=> trim($item->link),
  		'count'	=> count($fg),
  		'date'	=> date("j.n.Y H:i", (int) $item->timestamp),
  		'desc'	=> $file
  	];
  }
  echo json_encode($data);

}else{
  echo 'username,repo,token';
}
