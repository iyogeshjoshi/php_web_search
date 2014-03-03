How to use?
===============
Download this repo, then import the following file 
```
WebSearch.php
```
Instantiate a object of the **WebSearch** class then initiate all parametes via object or pass it to the function **execute**, here is an example
```
<?php
	include 'WebSearch.php';
	// get query from url
	if (isset($_GET["query"]))
		$query = urldecode($_GET['query']);
	else
		$query = "Yogesh Joshi";
		
	// get site from url
	if (isset($_GET["site"]))
		$site = urldecode($_GET["site"]);
	else
		$site = "www.iyogeshjoshi.com";

	$websearch = new WebSearch();
  
	// Either this way
	$websearch->query = $query;
	$websearch->site = $site;
	// number of results to be checked
	$websearch->num = 100;
	$result = $websearch->execute();
	print_r($result);
	
	// OR this way
	$websearch->num = 100;
	$result = $websearch->execute($query, $site);
	print_r($result);
?>
```

A PHP Class which returns the rank of the site provided, and number of time it appears in the search, based on the query provided to search
