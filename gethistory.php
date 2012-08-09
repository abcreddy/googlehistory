<?php

//Set the path to the cookie file you're going to use (IE format) - see README for more information
$google_cookie='/path/to/cookies.txt';

$start = 1;

//Loop through all the items
do {
	//Set the cURL options
	$ch = curl_init("https://www.google.com/history/lookup?q=&output=rss&start=".$start."&num=1000");
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_COOKIEJAR, $google_cookie);
	curl_setopt ($ch, CURLOPT_COOKIEFILE, $google_cookie);
	$curl_result = curl_exec ($ch);
	curl_close($ch);

	//Take the output ($curl_result) and turn it into a SimpleXML object
	$xml = simplexml_load_string($curl_result)->channel[0];

	//loop through the items
	foreach ($xml->item as $item) {
		//do something to each item

		//Option 1: output it to the browser
		header("Content-Type: text/plain");
		echo $item->title;
		echo "\n";
		echo $item->pubDate;
		echo "\n";
		echo $item->category;

		/*
		Option 2: stick it in a MySQL database
		You'll need to supply a MySQL connection string at the beginning of the script
		If magic quotes are off, you'll need to use mysql_real_escape_string() or addslashes() to escape quotes
		*/
		$db_host = 'localhost';
		$db_username = 'john';
		$db_password = '12345';
		$db_name = 'search_history';
		
		mysql_connect ($db_host, $db_username, $db_password) or die ('I cannot connect to the database because: ' . mysql_error());
		$db = mysql_select_db ($db_name);
		
		$query = "INSERT INTO `HISTORY` (`TITLE, `PUB_DATE`, `CATEGORY`) VALUES ('".mysql_real_escape_string($item->title)."', '".mysql_real_escape_string($item->pubDate)."', '".mysql_real_escape_string($item->category)."')";
        $result = mysql_result($query) or die(mysql_error());

        /*
		Option 3: Whatever you want!		
		The information you can use is pretty self-explanatory:
		<item>
			<title>github gist</title>
			<link>http://www.google.com/search?q=github+gist&amp;hl=en</link>
			<pubDate>Sat, 13 Feb 2010 04:30:41 GMT</pubDate>
			<category>web query</category>
			<description>1 result(s)</description>
			<guid isPermaLink="false">8Sp2S_v3E3swOqHLCNI6oA</guid>
		</item>
		'title' is the text of your query
		'link' is the URL of the query
		'pubDate' is when you ran the search
		'category' is the type of search: some of the possible types are 'web query', 'image query', and 'maps query'
		*/
	}

	//Go to the next page of your history
	$start += 1000;
	
} while (count($xml->item));

?>