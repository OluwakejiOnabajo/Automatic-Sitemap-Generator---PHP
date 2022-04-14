

<?php   include_once 'config.php';

$xml = new DOMDocument("1.0");
$date = "2022-04-13T01:00:44+01:00"; //date("Y-m-d\Th:m:s\Z");

// It will format the output in xml format otherwise
// the output will be in a single row
$xml->formatOutput=true;

$domElement=$xml->createElement("urlset");
$domAttribute=$xml->createAttribute("xmlns");
$domAttribute1=$xml->createAttribute("xmlns:xsi");
$domAttribute2=$xml->createAttribute("xmlns:xhtml");
$domAttribute3=$xml->createAttribute("xsi:schemaLocation");
$domAttribute->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
$domAttribute1->value = 'http://www.w3.org/2001/XMLSchema-instance';
$domAttribute2->value = 'http://www.w3.org/1999/xhtml';
$domAttribute3->value = 'http://www.sitemaps.org/schemas/sitemap/0.9
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
    http://www.w3.org/1999/xhtml
    http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd';

$domElement->appendChild($domAttribute);
$domElement->appendChild($domAttribute1);
$domElement->appendChild($domAttribute2);
$domElement->appendChild($domAttribute3);

$xml->appendChild($domElement);

$home = 'https://vote.nulass.org.ng/';

 $url=$xml->createElement("url");
    $domElement->appendChild($url);
     
    $loc=$xml->createElement("loc", $home);
    $url->appendChild($loc);
   
    $lastmod=$xml->createElement("lastmod", $date);
    $url->appendChild($lastmod);
    
    $priority = 1.00;
    $priority=$xml->createElement("priority", $priority);
    $url->appendChild($priority);
    
    $url=$xml->createElement("url");
    $domElement->appendChild($url);
     
    $loc=$xml->createElement("loc", $home);
    $url->appendChild($loc);
    
    $lastmod=$xml->createElement("lastmod", $date);
    $url->appendChild($lastmod);
    
    $priority = 1.00;
    $priority=$xml->createElement("priority", $priority);
    $url->appendChild($priority);

$default_file = array("national-executive-council", "divisional-bodies", "senators", "gallery", "blog", "about", "contact", "donation", "payments", "events");

foreach ($default_file as $file) {
   $url=$xml->createElement("url");
    $domElement->appendChild($url);
     
     $item = $home.$file;
    $loc=$xml->createElement("loc", $item);
    $url->appendChild($loc);
    
    $lastmod=$xml->createElement("lastmod", $date);
    $url->appendChild($lastmod);
    
    $priority = 0.80;
    $priority=$xml->createElement("priority", $priority);
    $url->appendChild($priority);
}

 $stmt = $conn->prepare("SELECT DISTINCT cat_slug from blog_posts");
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($cat_slug);
          if($stmt->num_rows > 0){
          while($stmt->fetch()){

    $url=$xml->createElement("url");
    $domElement->appendChild($url);
     
     $item = "https://nulass.org.ng/blog/".$cat_slug;
    $loc=$xml->createElement("loc", $item);
    $url->appendChild($loc);
    
    $lastmod=$xml->createElement("lastmod", $date);
    $url->appendChild($lastmod);
    
    $priority = 0.64;
    $priority=$xml->createElement("priority", $priority);
    $url->appendChild($priority);
	
}}


$stmt = $conn->prepare("SELECT DISTINCT event_slug from events");
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($event_slug);
          if($stmt->num_rows > 0){
          while($stmt->fetch()){
                      
    $url=$xml->createElement("url");
    $domElement->appendChild($url);
     
     $item = "https://nulass.org.ng/events/".$event_slug;
    $loc=$xml->createElement("loc", $item);
    $url->appendChild($loc);
    
    $lastmod=$xml->createElement("lastmod", $date);
    $url->appendChild($lastmod);
    
    $priority = 0.64;
    $priority=$xml->createElement("priority", $priority);
    $url->appendChild($priority);
	
}}

echo "<xmp>".$xml->saveXML()."</xmp>";
$xml->save("sitemap.xml");

?>
