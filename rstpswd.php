<?php
 require_once "Q_ueryBuild.php";
 $db = new Q_ueryBuild();
function valuate($vals,$cols){
    foreach($cols as $d){
            array_push($vals,filter_input(INPUT_GET, $d,
                            FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }
        return $vals;
}
function valuesToString($cols){
    $what ="";
    foreach($cols as $d){
        $what .= $d . "='".filter_input(INPUT_GET, $d,
                        FILTER_SANITIZE_FULL_SPECIAL_CHARS)."',";
    }
    return substr($what,0 ,strlen($what)-1);
}
function selU($e,$db) {
    //$db = new Q_ueryBuild();
    $qry = $db->slct("id", "users","email='$e'");
    $s =$db->transaction($qry);
    $s->execute();
    return $s->fetch()["id"];
}
 
// $db = new Q_ueryBuild();
 if (filter_input(INPUT_GET, "s")=="gu"){
    $qry = $db->slct("*", "users","1=1");
    $s =$db->transaction($qry);
    $r = $s->execute();
    echo json_encode([$s->fetchAll(),$s->queryString,$r]);
 }
if (filter_input(INPUT_GET, "s")=="iu"){
    try{
    $cols = ["email","password"];
    $vals = valuate([], $cols);
    $qry = $db->insert("users", $cols, $vals);
    $s =$db->transaction($qry);
    $r = $s->execute();
    echo json_encode([$db->db->lastInsertId(),$r]);
    } catch (Exception $e){
        echo $e->getMessage();
    }
}
if (filter_input(INPUT_GET, "s")=="uu"){
    $e = filter_input(INPUT_GET, "e");
    $id =selU($e, $db);
    $what = "password= '" .filter_input(INPUT_GET, "p") . "'";
    $qry = $db->update("users", $what, $id);
    $s =$db->transaction($qry);
    $r = $s->execute();
    echo json_encode([$s->errorCode(),$r]);
}

$token = filter_input(INPUT_GET, "token");
try{
$c = curl_init();
$root = "http://localhost/dgmtv/";
$url = $root."rstpswd.php?t=".$token;
curl_setopt($c, CURLOPT_URL,$url);
curl_setopt($c, CURLOPT_HEADER, 0);
curl_exec($c);
curl_close($c);
} catch (Exception $e)
{
	echo $e->getTraceAsString();
}



if ( (strlen(filter_input(INPUT_GET, "t"))>0)){
	$token = filter_input(INPUT_GET, "t");
	//echo base64_decode(str_rot13($token));
	$json = base64_decode(str_rot13($token));
	$obj = json_decode($json);
	
}

if ( (strlen(filter_input(INPUT_GET, "t"))>0)){
	$token = filter_input(INPUT_GET, "t");
	//echo base64_decode(str_rot13($token));
	$json = base64_decode(str_rot13($token));
	$obj = json_decode($json);
	
}