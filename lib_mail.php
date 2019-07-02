<?php
/**
 * @package TempMailKu
 * @author Izzeldin Addarda <zeldin26@gmail.com>
 */

function getMail(){
    global $site;
    $mail = curl("".$site."user.php");
    return array("currentmail" => $mail[1], "cookie" => fetch_cookies($mail[0]));
}
function readMail($mail){
    global $site;
    $header = array();
    $header[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0";
    $header[] = "Accept: */*";
    $header[] = "Accept-Language: id,en-US;q=0.7,en;q=0.3";
    $header[] = "Referer: ".$site."";
    $header[] = "X-Requested-With: XMLHttpRequest";
    $header[] = "Connection: keep-alive";
    $header[] = "Cookie: _ga=GA1.2.1967595283.1554543533; _gid=GA1.2.170453192.1554543533; tmail-emails=".urlencode('a:4:{i:0;s:17:"'.$mail['currentmail'].'";}')."; PHPSESSID=".$mail['cookie']['PHPSESSID']."; _gat_gtag_UA_137021416_1=1";
    $c = curl("".$site."mail.php", 0, $header);
    return $c[1];
}
function checkMsg($mail){
    global $site;
    $header = array();
    $header[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0";
    $header[] = "Accept: */*";
    $header[] = "Accept-Language: id,en-US;q=0.7,en;q=0.3";
    $header[] = "Referer: ".$site."";
    $header[] = "X-Requested-With: XMLHttpRequest";
    $header[] = "Connection: keep-alive";
    $header[] = "Cookie: _ga=GA1.2.1967595283.1554543533; _gid=GA1.2.170453192.1554543533; tmail-emails=".urlencode('a:4:{i:0;s:17:"'.$mail['currentmail'].'";}')."; PHPSESSID=".$mail['cookie']['PHPSESSID']."; _gat_gtag_UA_137021416_1=1";
    $c = curl("".$site."mail.php?unseen=1", 0, $header);
    // if(isset($c[1])){
    //     return json_encode(array("count" => 1));
    // }else{
    //     return json_encode(array("count" => 0));
    // }
    return $c[1];
}
?>
