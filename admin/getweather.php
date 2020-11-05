<?php
function fungsiCurl($url){
  $data = curl_init();
  curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($data, CURLOPT_URL, $url);
  curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
  $hasil = curl_exec($data);
  curl_close($data);
  return $hasil;
}
$url = fungsiCurl('http://www.bmkg.go.id/cuaca/prakiraan-cuaca.bmkg?Kota=Ternate&AreaID=501394&Prov=21');
$pecah = explode('<h2 class="kota">', $url);
$pecah1 = explode('<img src="', $pecah[1]);
$pecah2 = explode('<h2 class="heading-md">', $pecah1[1]);
$dh = str_replace('</h2>', '', $pecah1[0]);
$dh = str_replace('<div class="kiri">', '', $dh);
$exp = explode('"', $pecah1[1]);
$img = $exp[0];
$xsuhu = $pecah2[1];
$exps = explode('</h2>', $xsuhu);
$suhu = $exps[0];

$pecahx = explode('">', $pecah1[1]);
$pecahxx = explode('<p>', $pecahx[1]);
$pecahxxx = explode('</p>', $pecahxx[1]);
$txt = $pecahxxx[0];

$weather = array('w'=>trim($dh), 't'=>$txt, 'i'=>str_replace("https", "http", $img), 's'=>substr($suhu, 0, 2), "d"=>date('d F Y'));
echo json_encode($weather, JSON_UNESCAPED_SLASHES);
?>
