<?php 
    /*Pega data nesse formato AAAA-MM-DD 
    e retorna no seguinte formato DD/MM/AAAA
    */
    function retornaDataFormatoBr($data){
        $arrayData = explode('-',$data);

        return $arrayData[2]."/".$arrayData[1]."/".$arrayData[0];
    }
    /*Pega data nesse formato DD/MM/AAAA
    e retorna no seguinte formato AAAA-MM-DD 
    */
    function retornaDataFormatoBanco($data){
        $arrayData = explode('/',$data);

        return $arrayData[2]."-".$arrayData[1]."-".$arrayData[0];
    }
?>