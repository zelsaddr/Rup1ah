<?php
/**
 * @package Rupiah Bot
 * @author Izzeldin Addarda <zeldin26@gmail.com>
 */

require __DIR__."/module.php";
require __DIR__."/lib_mail.php";

$sites = array(
    "http://www.fake-mail.net/",
    "http://temp-email.info/",
    "https://megamail.cx/",
    "https://tempmailid.com/"
);
#########################################################################################################
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; '.RandomPhone().' Build/PQ3A.190605.006)';
$headers[] = 'Host: freerupiah.online';
$headers[] = 'Connection: Keep-Alive';
#########################################################################################################
while(true){
    $site = $sites[array_rand($sites)];
    $get_mail = getMail();
    echo $site."\n";
    #########################################################################################################
    $email      = $get_mail['currentmail'];
    $pin        = rand(111111, 555555);
    $name       = get_random_name();
    $refferal   = "3105"; // Your Refferal Code
    $imei       = imeiRandom();
    $alamat     = generate_address()['alamat'];
    #########################################################################################################
    $post_data = array(
        "telp"      => $email,
        "pin"       => $pin,
        "nama"      => $name['fullname'],
        "referal"   => $refferal,
        "imei"      => $imei,
        "alamat"    => $alamat
    );
    $post_body = http_build_query($post_data);
    $post = curl("http://freerupiah.online/api_juni19/register.php", $post_body, $headers);
    if(preg_match("/BERHASIL/i", $post[1])){
        foreach($post_data as $index => $value){
            echo strtoupper($index) ." : ".$value."\n";
        }
        do{
            $chk = checkMsg($get_mail);
            echo "# CHECKING EMAIL...\n";
        }while($chk == NULL);
        $read = readMail($get_mail);
        preg_match('#berikut : (.*?)</div>#si', $read, $verif_url);
        isset($verif_url[1]) ? $msg = curl(trim($verif_url[1]))[1] : $msg = "# NO VERIF URL\n";
        echo preg_match("/SUKSES/i", $msg) == true ? "# VERIFIKASI DONE\n" : $msg;
    }else{
        echo "# FAILED REGISTER...\n";
    }
    $sl = rand(600, 4000);
    echo "Will Sleep In ".$sl." Seconds.\n";
    sleep($sl);
}
?>
