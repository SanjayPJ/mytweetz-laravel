<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Twitter;
use \File;

class TwitterController extends Controller
{
	private $count = 20;
	private $format = 'array';

    public function twitterUserTimeline(){
    	$data = Twitter::getUserTimeline(['count' => $this->count, 'format' => $this->format]);
    	return view('twitter')->with('data', $data);
    }

    public function tweet(Request $request){
    	$this->validate($request, [
    		'tweet' => 'required'
    	]);

    	$new_tweet = [ 'status' => $request->tweet ];
    	if(!empty($request->images)){
    		foreach ($request->images as $key => $image) {
    			$upload_media = Twitter::uploadMedia(['media' => File::get($image->getRealPath())]);
    			if(!empty($upload_media)){
    				$new_tweet['media_ids'][$upload_media->media_id_string] = $upload_media->media_id_string;
    			}
    		}
    	}
    	$twitter = Twitter::postTweet($new_tweet);
    	return back();
    }
}
