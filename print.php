<?php
	require __DIR__."/vendor/autoload.php";
	require __DIR__.'/config.php';
	use Abraham\TwitterOAuth\TwitterOAuth;

	//, $access_token, $access_token_secret
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$content = $connection->get(
		"search/tweets", 
		[
			'q' => '#'.join(' OR #', $HASHTAGS).' filter:images',
			'count' => 5,
		]
	);

	if(isset($content->errors)){
		foreach($content->errors as $error)
			echo 'Error #'.$error->code.': '.$error->message;
		exit;
	}

	if(!isset($content->statuses))
		die('No results found');

	shuffle($content->statuses);

	foreach($content->statuses as $post){

		if(isset($post->entities->media)){

			foreach($post->entities->media as $item){

				if($item->type === 'photo'){

					$image = $item->media_url;

					$image = imagepng(imagecreatefromstring(file_get_contents($image)), __DIR__."/printme.png");
					
					// Uncomment to print live
					exec('lp '.__dir__.'/printme.png');
					echo 'Printed successfully!';

					return;

				}

			}

			
		}

	}

	echo 'No photos found :(';

