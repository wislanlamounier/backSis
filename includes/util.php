<?php 

function data_padrao_americano($data){
      if(strpos($data, '/') === false){
          return $data;
      }else{
          $d = explode('/', $data);
          return $d[2] .'-'.$d[1].'-'.$d[0];
      }
}

function data_padrao_brasileiro($data){
      if(strpos($data, '-') === false){
          return $data;
      }else{
          $d = explode('-', $data);
          return $d[2] .'/'.$d[1].'/'.$d[0];
      }
}

 ?>