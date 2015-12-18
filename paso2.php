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

    function scajas() {
        $s1 = array(array(14,4,13,1,2,15,11,8,3,10,6,12,5,9,0,7),
                    array(0,15,7,4,14,2,13,1,10,6,12,11,9,5,3,8),
                    array(4,1,14,8,13,6,2,11,15,12,9,7,3,10,5,0),
                    array(15,12,8,2,4,9,1,7,5,11,3,14,10,0,6,13)
        );
        $s2 = array(array(15,1,8,14,6,11,3,4,9,7,2,13,12,0,5,10),
                    array(3,13,4,7,15,2,8,14,12,0,1,10,6,9,11,5),
                    array(0,14,7,11,10,4,13,1,5,8,12,6,9,3,2,15),
                    array(13,8,10,1,3,15,4,2,11,6,7,12,0,5,14,9)
            );
        $s3 = array(array(10,0,9,14,6,3,15,5,1,13,12,7,11,4,2,8),
                    array(13,7,0,9,3,4,6,10,2,8,5,14,12,11,15,1),
                    array(13,6,4,9,8,15,3,0,11,1,2,12,5,10,14,7),
                    array(1,10,13,0,6,9,8,7,4,15,14,3,11,5,2,12)
           );
        $s4 = array(array(7,13,14,3,0,6,9,10,1,2,8,5,11,12,4,15),
                    array(13,8,11,5,6,15,0,3,4,7,2,12,1,10,14,9),
                    array(10,6,9,0,12,11,7,13,15,1,3,14,5,2,8,4),
                    array(3,15,0,6,10,1,13,8,9,4,5,11,12,7,2,14)
            );
        $s5 = array(array(2,12,4,1,7,10,11,6,8,5,3,15,13,0,14,9),
                    array(14,11,2,12,4,7,13,1,5,0,15,10,3,9,8,6),
                    array(4,2,1,11,10,13,7,8,15,9,12,5,6,3,0,14),
                    array(11,8,12,7,1,14,2,13,6,15,0,9,10,4,5,3)
            );
        $s6 = array(array(12,1,10,15,9,2,6,8,0,13,3,4,14,7,5,11),
                    array(10,15,4,2,7,12,9,5,6,1,13,14,0,11,3,8),
                    array(9,14,15,5,2,8,12,3,7,0,4,10,1,13,11,6),
                    array(4,3,2,12,9,5,15,10,11,14,1,7,6,0,8,13)
            );
        $s7 = array(array(4,11,2,14,15,0,8,13,3,12,9,7,5,10,6,1),
                    array(13,0,11,7,4,9,1,10,14,3,5,12,2,15,8,6),
                    array(1,4,11,13,12,3,7,14,10,15,6,8,0,5,9,2),
                    array(6,11,13,8,1,4,10,7,9,5,0,15,14,2,3,12)
            );
        $s8 = array(array(13,2,8,4,6,15,11,1,10,9,3,14,5,0,12,7),
                    array(1,15,13,8,10,3,7,4,12,5,6,11,0,14,9,2),
                    array(7,11,4,1,9,12,14,2,0,6,10,13,15,3,5,8),
                    array(2,1,14,7,4,10,8,13,15,12,9,0,3,5,6,11)
            );



}
}