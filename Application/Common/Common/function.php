<?php
function getTestData(){
	$data=array();
	for($i=0;$i<10;$i++){
		$data[$i]['name']='user-'.$i;
		$data[$i]['age']=rand(18,90);
	}
	return $data;
}
function jump($url){
	echo " <script   language = 'javascript'
type = 'text/javascript' > ";
	echo " window.location.href = '$url' ";
	echo " </script > ";
}
function show_bug($msg){
	echo "<pre style='color:red'>";
	var_dump($msg);
	echo "</pre>";
}
//兼容低版本（php环境5.5版本以下）的函数
/*
    function array_column($input, $columnKey, $indexKey=null){
        $columnKeyIsNumber      = (is_numeric($columnKey)) ? true : false;
        $indexKeyIsNull         = (is_null($indexKey)) ? true : false;
        $indexKeyIsNumber       = (is_numeric($indexKey)) ? true : false;
        $result                 = array();
        foreach((array)$input as $key=>$row){
            if($columnKeyIsNumber){
                $tmp            = array_slice($row, $columnKey, 1);
                $tmp            = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null;
            }else{
                $tmp            = isset($row[$columnKey]) ? $row[$columnKey] : null;
            }
            if(!$indexKeyIsNull){
                if($indexKeyIsNumber){
                    $key        = array_slice($row, $indexKey, 1);
                    $key        = (is_array($key) && !empty($key)) ? current($key) : null;
                    $key        = is_null($key) ? 0 : $key;
                }else{
                    $key        = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }
            $result[$key]       = $tmp;
        }
        return $result;
    } */
?>