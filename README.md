# GoogleImageSearch PHP Class

## Description 
A PHP class for image search with Google API

## Requirements
Requires CURLQuery PHP class for cURL calls : [https://github.com/josuecau/CURLQuery](You can found it here). 

## Usage
     $search = new GoogleImageSearch( 'YOUR_GOOGLE_API_KEY' );
     $search->q = 'elephpant';
     $search->setSearchCount( 64 );
     $search->sendQuery();
     $images_urls = $search->getImagesUrl();

