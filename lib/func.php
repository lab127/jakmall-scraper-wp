<?php 

function grabit($turl) {

	$ua   = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 Firefox/15.0a1|Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0|Mozilla/5.0 (Windows NT 6.1; de;rv:12.0) Gecko/20120403211507 Firefox/12.0|Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)|Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)|Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; chromeframe/13.0.782.215)|Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; InfoPath.2)|Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10|Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1|Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27|Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.9 Safari/536.5|Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1090.0 Safari/536.6|Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1061.0 Safari/536.3|Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00|Opera/9.80 (Windows NT 6.0; U; pl) Presto/2.10.229 Version/11.62|Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; de) Opera 11.51';

	$xua  = explode('|',$ua);
	$tua  = count($xua);
	$lidx = $tua-1;
	$ridx = mt_rand(0,$lidx);
	$theua = $xua[$ridx];
	//Houston, we have random user agent: $theua;

	//User Agent + Header Settings
	ini_set('user_agent', $theua);
	$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en-us,en\r\n"));
	$context = stream_context_create($opts);

	//Open the file using the HTTP headers set above
	$grabit = file_get_contents($turl,false,$context);
	//echo $grabit;

	//MINIFIKASI/MINIFY
	$grabit = str_replace(array("\n","\r","\r\n","\n\r","\t","    ","   ","  "),'',$grabit);
	$grabit = str_replace('> <','><',$grabit);

	return $grabit;
}

function grabimg($turl, $tloc) {

	$ua   = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 Firefox/15.0a1|Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0|Mozilla/5.0 (Windows NT 6.1; de;rv:12.0) Gecko/20120403211507 Firefox/12.0|Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)|Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)|Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; chromeframe/13.0.782.215)|Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; InfoPath.2)|Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10|Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1|Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27|Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.9 Safari/536.5|Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1090.0 Safari/536.6|Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1061.0 Safari/536.3|Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00|Opera/9.80 (Windows NT 6.0; U; pl) Presto/2.10.229 Version/11.62|Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; de) Opera 11.51';

	$xua  = explode('|',$ua);
	$tua  = count($xua);
	$lidx = $tua-1;
	$ridx = mt_rand(0,$lidx);
	$theua = $xua[$ridx];
	//Houston, we have random user agent: $theua;

	//User Agent + Header Settings
	ini_set('user_agent', $theua);
	$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en-us,en\r\n"));
	$context = stream_context_create($opts);

	//Open the file using the HTTP headers set above
	$file = file_get_contents($turl,false,$context);

    // if (!empty($tloc)) {
    //     $filename = pathinfo(preg_replace('/\?.*$/i', '', $turl), PATHINFO_BASENAME);
    //     $filepath = $tloc . $filename;    
    // } else {
    //     $filepath = $tloc;
    // }

    file_put_contents($tloc, $file);
    
}

function getWebPage( $url ) {

	$ua = ['Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20120427 Firefox/15.0a1', 'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20120403211507 Firefox/12.0', 'Mozilla/5.0 (Windows NT 6.1; de;rv:12.0) Gecko/20120403211507 Firefox/12.0', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 'Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; chromeframe/13.0.782.215)', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; InfoPath.2)', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/534.55.3 (KHTML, like Gecko) Version/5.1.3 Safari/534.53.10', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1', 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.9 Safari/536.5', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1090.0 Safari/536.6', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.3 (KHTML, like Gecko) Chrome/19.0.1061.0 Safari/536.3', 'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00', 'Opera/9.80 (Windows NT 6.0; U; pl) Presto/2.10.229 Version/11.62', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; de) Opera 11.51'];

	$tua = count($ua);
	$lid = $tua - 1;
    $rid = mt_rand(0, $lid);
    
	$user_agent = $ua[$rid];
    // $user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36";
  
    $http_header = array( 
      "Accept: text/xml,application/xml,application/xhtml+xml,",
      "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5",
      "Cache-Control: max-age=0",
      "Connection: keep-alive",
      "Keep-Alive: 300",
      "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
      "Accept-Language: en-us,en;q=0.5",
      "Pragma: "
    );
  
    $referer = 'localhost';
  
    $options = array(
      CURLOPT_RETURNTRANSFER => true,     // return web page
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_HEADER         => false,    // don't return headers
      CURLOPT_FOLLOWLOCATION => true,     // follow redirects
      CURLOPT_ENCODING       => "",       // handle all encodings
      CURLOPT_USERAGENT      => $user_agent, // who am i
      CURLOPT_AUTOREFERER    => true,     // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
      CURLOPT_TIMEOUT        => 120,      // timeout on response
      CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
      CURLOPT_HTTPHEADER     => $http_header,
      CURLOPT_COOKIEFILE     => "cookie.txt",
      CURLOPT_COOKIEJAR      => "cookie.txt",
      CURLOPT_REFERER        => $referer
    );
  
    $ch       = curl_init( $url );
  
    curl_setopt_array( $ch, $options );
  
    $content  = curl_exec( $ch );
    $content  = str_replace(array("\n","\r","\r\n","\n\r","\t","    ","   ","  "),'',$content);
    $content  = str_replace('> <','><',$content);
  
    curl_close( $ch );
  
    return $content;
}

// http://php.net/manual/en/book.dom.php#89718
function domInnerHtml($element) { 
    $innerHTML = ""; 
    $children = $element->childNodes; 
    foreach ($children as $child) 
    { 
        $tmp_dom = new DOMDocument(); 
        $tmp_dom->appendChild($tmp_dom->importNode($child, true)); 
        $innerHTML.=trim($tmp_dom->saveHTML()); 
    } 
    return $innerHTML; 
} 

function saveto($save, $raw) {
    if(file_exists($save)) {
        unlink($save);
    }

    $fp = fopen($save,'x');
    fwrite($fp, $raw);
    fclose($fp);
}

function slugify($text) { 
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	// trim
	$text = trim($text, '-');

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// lowercase
	$text = strtolower($text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;

}

function cropit($source, $destination, $width = 10, $height = 20){

	$getres = getimagesize($source);

	$new_width = $getres[0] - $width;
	$new_height = $getres[1] - $height;

	$img = imagecreatetruecolor($new_width, $new_height);
	$org_img = imagecreatefromjpeg($source);

	imagecopy($img,$org_img, 0, 0, 0, 0, $new_width, $new_height);
	imagejpeg($img,$destination, 100);
	imagedestroy($img);

	return $destination;

}

function imagit($url,$saveto,$referer) {
    $ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    $raw = curl_exec($ch);
    curl_close ($ch);

    if(file_exists($saveto)) {
        unlink($saveto);
    }

    $fp = fopen($saveto,'x');
    fwrite($fp, $raw);
    fclose($fp);
}


function imagem($urls, $user_agent, $folder) {

    // $filepaths = array();

    // cURL multi-handle
    $mh = curl_multi_init();

    // This will hold cURLS requests for each file
    $requests = array();

    $options = array(
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_AUTOREFERER    => true, 
        CURLOPT_USERAGENT      => $user_agent,
        CURLOPT_HEADER         => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT		   => 120,
        CURLOPT_RETURNTRANSFER => true
    );

    //Corresponding filestream array for each file
    $fstreams = array();

    foreach ($urls as $key => $url) {
        // Add initialized cURL object to array
        $requests[$key] = curl_init($url);

        // Set cURL object options
        curl_setopt_array($requests[$key], $options);
        // Extract filename from URl and create appropriate local path
        $path     = parse_url($url, PHP_URL_PATH);
        $filename = pathinfo($path, PATHINFO_BASENAME); // Or whatever you want

        $filepath = $folder . $filename;

        // $filepaths []= $filepath;

        // Open a filestream for each file and assign it to corresponding cURL object
        $fstreams[$key] = fopen($filepath, 'w');
        curl_setopt($requests[$key], CURLOPT_FILE, $fstreams[$key]);

        // Add cURL object to multi-handle
        curl_multi_add_handle($mh, $requests[$key]);
    }

    // Do while all request have been completed
    do {
       curl_multi_exec($mh, $active);
    } while ($active > 0);

    
    // Collect all data here and clean up

    foreach ($requests as $key => $request) {

        //$returned[$key] = curl_multi_getcontent($request); // Use this if you're not downloading into file, also remove CURLOPT_FILE option and fstreams array
        curl_multi_remove_handle($mh, $request); //assuming we're being responsible about our resource management
        curl_close($request);                    //being responsible again.  THIS MUST GO AFTER curl_multi_getcontent();
        fclose($fstreams[$key]);
        
    }

    curl_multi_close($mh);

    // return $filepaths;

}

// http://stackoverflow.com/a/10103901
// Find a randomDate between $start_date and $end_date
function randomDate($start_date, $end_date)
{
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    return date('Y-m-d H:i:s', $val);
}