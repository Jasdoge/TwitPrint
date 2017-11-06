<?php
	require __DIR__."/vendor/autoload.php";
	require __DIR__.'/config.php';
	use Abraham\TwitterOAuth\TwitterOAuth;

	if (!is_dir(__DIR__.'/temp')) {
		mkdir(__DIR__.'/temp');
	}

	//, $access_token, $access_token_secret
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$content = $connection->get(
		"statuses/user_timeline", 
		[
			'screen_name' => 'kabosumama', 
			'count' => 10, 
			'include_rts' => false
		]
	);

	if(isset($content->errors)){
		foreach($content->errors as $error)
			echo 'Error #'.$error->code.': '.$error->message;
		exit;
	}

	foreach($content as $post){

		if(isset($post->entities->media)){

			foreach($post->entities->media as $item){

				if($item->type === 'photo'){

					$image = $item->media_url;

					$image = imagepng(imagecreatefromstring(file_get_contents($image)), __DIR__."/temp/printme.png");
					exec('lp '.__dir__.'/temp/printme.png');
					echo 'Printed successfully!';

					return;

				}

			}

			
		}

	}

	echo 'No photos found :(';

