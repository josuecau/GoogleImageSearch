# GoogleImageSearch PHP Class

## Description 
A PHP class for image search with Google API

## Requirements
Require [CURLQuery PHP class](https://github.com/josuecau/CURLQuery) for cURL calls.
You also need a Google API Key.

## Usage
     $search = new GoogleImageSearch( 'YOUR_GOOGLE_API_KEY' );
     $search->q = 'elephpant';
     $search->setSearchCount( 64 );
     $search->sendQuery();
     $images_urls = $search->getImagesUrl();

See [this example](https://github.com/josuecau/GoogleImageSearch/blob/master/example.php)
