<?php
class clases {

        private $k;
        private $k_array;
        private $k_mas;
        private $k_mas_array;
        private $c;
        private $d;


    public function getK()
    {
        return $this->k;
    }


    public function getKMas()
    {
        return $this->k_mas;
    }

    public function getC()
    {
        return $this->c;
    }

    public function getD()
    {
        return $this->d;
    }
    function heca_binario($hexa) {
        $key = str_pad(base_convert($hexa,16,2),64,0, STR_PAD_LEFT);
        $this -> k = $key;
        $this -> k_array = str_split($key);

    }

    function pc1(){
        $tabla = array(57,49,41,33,25,17,9,1,58,50,42,34,26,18,10,2,59,51,43,35,27,19,11,3,60,52,44,36,63,55,47,39,31,23,15,7,62,54,46,38,30,22,14,6,61,53,45,37,29,21,13,5,28,20,12,4);
        $k_mas_array= array();
        $k_mas="";

        for($i=0;$i<56;$i++) {
            $posicion = $tabla[$i]-1;
            array_push($k_mas_array, $this -> k_array[$posicion]);
            $k_mas = $k_mas. $this -> k_array[$posicion];

        }
        $this -> k_mas = $k_mas;
        $this -> k_mas_array = $k_mas_array;

    }
}