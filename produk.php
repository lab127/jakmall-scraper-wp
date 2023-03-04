<?php 

require __DIR__ . "/lib/func.php";
require __DIR__ . "/lib/simplehtmldom/simple_html_dom.php";

include_once __DIR__ . '/../wp-load.php';

include_once __DIR__ . '/includes/attributes.php';
include_once __DIR__ . '/includes/variations.php';
include_once __DIR__ . '/includes/attachments.php';

global $wpdb;

function insert_product($product_data) {

	$post_date = randomDate('2019-01-01', date("Y-m-d"));

	$new_post = array( // Set up the basic post data to insert for our product
		'post_author'  => $product_data['author'],
		'post_content' => $product_data['description'],
		'post_excerpt' => $product_data['short_description'],
		'post_status'  => 'publish',
		'post_title'   => $product_data['name'],
		'post_parent'  => '',
		'post_date'    => $post_date,
		'post_type'    => 'product'
	);

	$post_id = wp_insert_post($new_post); // Insert the post returning the new post id

	if (!$post_id) // If there is no post id something has gone wrong so don't proceed
	{
		return false;
	}

	update_post_meta( $post_id, '_sku', $product_data['sku']); // Set its SKU
	update_post_meta( $post_id,'_visibility','visible'); // Set the product to visible, if not it won't show on the front end
	update_post_meta( $post_id, '_price', $product_data['price'] );
	update_post_meta( $post_id, '_regular_price', $product_data['price'] );
	update_post_meta( $post_id, '_stock_status', 'instock');
	update_post_meta( $post_id, 'total_sales', '0');
	update_post_meta( $post_id, '_downloadable', 'no'); // digital product
	update_post_meta( $post_id, '_virtual', 'no'); // digital product
	update_post_meta( $post_id, '_purchase_note', "" );
	update_post_meta( $post_id, '_featured', "no" );
	update_post_meta( $post_id, '_weight', $product_data['weight'] );
	update_post_meta( $post_id, '_length', 6 );
	update_post_meta( $post_id, '_width', 3 );
	update_post_meta( $post_id, '_height', 1 );
	update_post_meta( $post_id, '_sale_price_dates_from', "" );
	update_post_meta( $post_id, '_sale_price_dates_to', "" );
	update_post_meta( $post_id, '_sold_individually', "" );
	update_post_meta( $post_id, '_manage_stock', "yes" );
	update_post_meta( $post_id, '_backorders', "no" );
	update_post_meta( $post_id, '_stock', 100 );

	wp_set_object_terms($post_id, $product_data['categories'], 'product_cat'); // Set up its categories

	// $attachment_id = insert_product_attachment($product_data['author'], $product_data['attachment'], $post_id, $product_data['name'], $post_date);
	$att_ids = insert_product_attachment($product_data['author'], $product_data['attachment'], $post_id, $product_data['name'], $post_date);
	// add_post_meta($post_id, '_thumbnail_id', $attachment_id);
	add_post_meta($post_id, '_thumbnail_id', $att_ids[0]);
	unset($att_ids[0]);
	add_post_meta($post_id, '_product_image_gallery', implode(',', $att_ids)); 
	   
}

$url = "https://www.jakmall.com/skmei-indonesia/skmei-jam-tangan-analog-digital-pria-ad1270";

$webPage = getWebPage($url);

saveto(__DIR__ . '/y.txt', $webPage);

$html = file_get_html(__DIR__ . '/y.txt');

$title = "";

foreach ($html->find('script[type=application/ld+json]]') as $jsonschema) {
  $json = json_decode(str_replace('http:\/\/schema.org\/','',$jsonschema->innertext));
  $title .= $json->name;

}

preg_match_all('/var\sspdt\s+=\s+(\{.*?\});/i', $html, $match);

$jsondata = json_decode($match[1][0]);
$product_data = reset($jsondata->sku);
// var_dump($product_data);

$berat = $product_data->weight; // gram
$harga = $product_data->price->final;

$images_url = [];
foreach ($product_data->images as $imgdata) {
  $images_url []= $imgdata->detail;
}


$content = "";
foreach ($html->find('div.dp__info__wrapper') as $dpinfowrapper) {

  $desk = preg_replace('/<img.*?>/i', '', $dpinfowrapper->innertext);
  $desk = preg_replace('/<[^\/>][^>]*><\/[^>]+>/i', '', $desk);
  $desk = preg_replace('/<div\s+?class="h2".*?>(.*?)<\/div>/i', '<h4>$1</h4>', $desk);

  $content .= $desk;

}

$agents = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.73 Safari/537.36";
$tmp = __DIR__ . '/tmp/';

$imagepaths = array();
for ($i=0; $i < count($images_url); $i++) { 
	$img_basename = pathinfo(preg_replace('/\?.*$/i', '', $images_url[$i]), PATHINFO_BASENAME);
	$img_filename = pathinfo($img_basename, PATHINFO_FILENAME); // filename
	$img_extension = pathinfo($img_basename, PATHINFO_EXTENSION);
	$imagepath = $tmp . $img_filename . $i . '.' . $img_extension;
	$imagepaths []= $imagepath;
	grabimg($images_url[$i], $imagepath);
}

$product_data = array(
	"author" => 1,
	"name" => $title,
	"sku" => "test-1324",
	"description" => $content,
	"short_description" => "test excerpt",
	"categories" => array( "jam tangan", "fashion pria" ),
	"price" => $harga,
	"attachment" => $imagepaths,
	"weight" => $berat
);

insert_product($product_data);

?>