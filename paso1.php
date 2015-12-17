<?php
class paso1 {

        private $k;
        private $k_array;
        private $k_mas;
        private $k_mas_array;
        private $c0;
        private $d0;
        private $c_mas;
        private $d_mas;
        private $ki;
        private $ki_array;




    public function getK()
    {
        return $this->k;
    }


    public function getKMas()
    {
        return $this->k_mas;
    }

    public function getC0()
    {
        return $this->c0;
    }

    public function getCMas()
    {
        return $this->c_mas;
    }

    public function getD0()
    {
        return $this->d0;
    }

    public function getDMas()
    {
        return $this->d_mas;
    }

    public function getKi()
    {
        return $this->ki;
    }

    public function getKiArray()
    {
        return $this->ki_array;
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
$this->bloques();
    }

    function bloques() {
        $iteraciones = array(1,1,2,2,2,2,2,2,1,2,2,2,2,2,2,1);
        $c0 = substr($this -> k_mas, 0,28);
        $d0 = substr($this -> k_mas, 28,55);
        $c_mas = array("c0" => $c0);
        $d_mas = array("d0" => $d0);

        for ($i = 1,$j = 0 ;$i <= 16; $i++, $j++) {

            $a = substr($c_mas["c".$j],0, $iteraciones[$j]);
            $b = substr($c_mas["c".$j],$iteraciones[$j],28);

            $c_mas["c".$i] = $b.$a;

            $a = substr($d_mas["d".$j],0, $iteraciones[$j]);
            $b = substr($d_mas["d".$j],$iteraciones[$j],28);

            $d_mas["d".$i] = $b.$a;
        }
        $this -> c0 = $c0;
        $this -> d0 = $d0;
        $this -> c_mas = $c_mas;
        $this -> d_mas = $d_mas;
        $this->pc2();
    }

    function pc2() {
        $tabla = array(14,17,11,24,1,5,3,28,15,6,21,10,23,19,12,4,26,8,16,7,27,20,13,2,41,52,31,37,47,55,30,40,51,45,33,48,44,49,39,56,34,53,46,42,50,36,29,32);
        $ki = array();
        $ki["ki0"] = "";

        for($j = 0;$j < 48; $j++) {
            $a = $this -> c_mas["c0"].$this -> d_mas["d0"];
            $b = str_split($a);
            $pos = $tabla[$j]-1;
            $ki["ki0"] = $ki["ki0"].$b[$pos];
        }
        for($i = 0, $s = 1; $i < 16; $i++,$s++) {
            $a = $this -> c_mas["c".$s].$this -> d_mas["d".$s];
            $b = str_split($a);
            $ki["ki".$s] = "";
            for($j = 0;$j < 48; $j++) {
                $pos = $tabla[$j]-1;
                $ki["ki".$s] = $ki["ki".$s].$b[$pos];
            }

        }
        $this -> ki_array = $ki;
    }
}