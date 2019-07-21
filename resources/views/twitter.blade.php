<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MyTweetz</title>
	<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<style>
		*{
			font-family: 'Times New Roman';
			font-style: italic;
		}
		.text-bold{
			font-weight: bold
		}
	</style>
</head>
<body class="bg-light">
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <div class="container">
	  	<a class="navbar-brand" href="#">mytweetz</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">tweet something &rarr;<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	  </div>
	  </div>
	</nav>
	<div class="container">
		<div class="card mt-2">
		  <div class="card-body">
		    <form action="{{ route('post.tweet') }}" method="post" enctype="multipart/form-data" >
		    	@csrf
		    	@if(count($errors) > 0)
			    	@foreach($errors->all() as $error)
				    	<div class="alert alert-danger">
				    		{{ $error }}
				    	</div>
			    	@endforeach
		    	@endif
		    	<div class="row">
		    		<div class="col-md-7">
		    			<div class="form-group m-0">
						    <input name="tweet" type="text" placeholder="write something here..." class="form-control m-0" id="exampleInputEmail1" aria-describedby="emailHelp">
						  </div>
		    		</div>
		    		<div class="col-md-3">
		    			<div class="custom-file">
						  <input type="file" name="images[]" multiple class="custom-file-input" id="customFile">
						  <label class="custom-file-label" for="customFile">upload image</label>
						</div>
		    		</div>
		    		<div class="col-md-2">
		    			<button type="submit" class="btn btn-primary w-100" style="font-family: 'Times New Roman'">tweet it <i class="ml-2 fas fa-paper-plane"></i></button>	
		    		</div>
		    	</div>
		    </form>
		  </div>
		</div>
		<div class="card-columns">
			@if(!empty($data))
				@foreach($data as $key => $tweet)
				 <div class="">
				 	<div class="card mt-2">
					  <div class="card-body ml-5">
					      <h6 class="text-bold"><em>{{ $tweet['text'] }}</em></h6>
					      @if(!empty($tweet['extended_entities']['media']))
					      		@foreach($tweet['extended_entities']['media'] as $i)
					      		<img class="img-fluid rounded mb-2" src="{{ $i['media_url_https'] }}" alt="{{ $tweet['text'] }}">
					      		@endforeach
					      	@endif
					      <footer class="blockquote-footer">
					      	<cite title="Source Title">
					      		<strong><i class="fa fa-heart"></i> {{ $tweet['favorite_count'] }}</strong>
					      		<strong class="ml-3"><i class="fa fa-redo"></i> {{ $tweet['retweet_count'] }}</strong>
					      	</cite>
					      </footer>
					  </div>
					</div>
				 </div>
				@endforeach
			@endif
		</div>
		</div>
	</div>
</body>
</html>