<?php

require 'CURLQuery.php';
require 'GoogleImageSearch.php';

if ( !empty( $_REQUEST['q'] ) ) {

	try {
		$google_api_key = 'YOUR_GOOGLE_API_KEY';
		$search         = new GoogleImageSearch( $google_api_key );
		$search->q      = $_REQUEST['q'];
		$search->userip = $_SERVER['REMOTE_ADDR'];
		$search->setSearchCount( 64 );
		$search->sendQuery();
		$images_urls = $search->getImagesUrl();
	}
	catch ( Exception $e ) {
		die( $e->getMessage() );
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Google Image Search</title>
</head>
<body>
	
	<?php if( !empty( $images_urls ) AND is_array( $images_urls ) ) : ?>
		<pre><?php print_r( $images_urls ); ?></pre>
	<?php else : ?>
		<form action="" method="post">
			<input name="q" placeholder="Search term">
			<input type="submit">
		</form>
	<?php endif; ?>
	
</body>
</html>

