<?php
class paso2 {

    private $m;
    private $m_array;
    private $ip;
    private $ip_array;
    private $l;
    private $l_array;
    private $l_split;
    private $r;
    private $r_split;
    private $r_array;
    private $ki_r;





    public function getM()
    {
        return $this->m;
    }

    public function getMArray()
    {
        return $this->m_array;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getIpArray()
    {
        return $this->ip_array;
    }
    public function getL()
    {
        return $this->l;
    }

    public function getLSplit()
    {
        return $this->l_split;
    }

    public function getLArray()
    {
        return $this->l_array;
    }

    public function getR()
    {
        return $this->r;
    }

    public function getRSplit()
    {
        return $this->r_split;
    }
    public function getRArray()
    {
        return $this->r_array;
    }
    public function getKir()
    {
        return $this->ki_r;
    }

    function binary($mensaje) {
        $m = str_pad(base_convert($mensaje,16,2),64,0, STR_PAD_LEFT);


        $this -> m = $m;
        $this -> m_array = str_split($m);
    $this->tablaIP();
    }

    function tablaIP() {
        $tabla = array(58,50,42,34,26,18,10,2,60,52,44,36,28,20,12,4,62,54,46,38,30,22,14,6,64,56,48,40,32,24,16,8,57,49,41,33,25,17,9,1,59,51,43,35,27,19,11,3,61,53,45,37,29,21,13,5,63,55,47,39,31,23,15,7);
        $ip = "";
        $ip_array = array();

        for($i=0;$i<64;$i++) {
            $posicion = $tabla[$i]-1;
            array_push($ip_array, $this -> m_array[$posicion]);
            $ip = $ip. $this -> m_array[$posicion];

        }
        $this -> l = substr($ip, 0,32);
        $this -> l_split = str_split($this -> l);
        $this -> r = substr($ip, 32,64);
        $this -> r_split = str_split($this -> r);
        $this -> l_array[0] = $this -> l;
        $this -> ip = $ip;
        $this -> ip_array = $ip_array;
        $this -> r_array[0] = $this -> r;
        $this->tablaE();

    }
    function tablaE () {
        $tabla = array(32,1,2,3,4,5,4,5,6,7,8,9,8,9,10,11,12,13,12,13,14,15,16,17,16,17,18,19,20,21,20,21,22,26,24,25,24,25,26,27,28,29,28,29,30,31,32,1);
        $iteraciones = array(1,1,2,2,2,2,2,2,1,2,2,2,2,2,2,1);

//Iteramos sobre la variable L.

        for ($i=0, $j=1; $i < 16; $i++, $j++) {
            $a = substr($this -> l_array[$i], 0, $iteraciones[$i]);
            $b = substr($this -> l_array[$i], $iteraciones[$i], 32);
            $this ->l_array[$j] = $b.$a;

//Iteramos sobre la variable R.

            $a = substr($this -> r_array[$i], 0, $iteraciones[$i]);
            $b = substr($this -> r_array[$i], $iteraciones[$i], 32);
            $this ->r_array[$j] = $b.$a;

        }
//Usamos la tabla de permutación E

        $z = str_split($this -> r_array[0]);
        $this -> r_array[0] = "";
    for($s=0;$s < 48;$s++) {
        $this -> r_array[0] = $this -> r_array[0].$z[$tabla[$s]-1];
    }

    for($i=0, $j=1;$i < 16; $i++, $j++) {
        $a = str_split($this -> r_array[$j]);
        $temp = "";
        $this -> r_array[$j] = "";
        for($s=0;$s < 48;$s++) {
            $this -> r_array[$j] = $this -> r_array[$j].$a[$tabla[$s]-1];
        }
    }

    }

    function xorf($ki) {
        $this -> ki_r = array();
        for($i = 0; $i < 16;$i++) {
            $a = str_split($ki["ki".($i+1)]);
            $b = str_split($this -> r_array[$i]);


            $this -> ki_r[$i] = "";
            for ($j=0;$j<48;$j++) {

                if($a[$j] != $b[$j]){
                    $h = 1;
                } else {
                    $h=0;
                }
                $this -> ki_r[$i] = $this -> ki_r[$i].$h;
            }



        }
    }
}