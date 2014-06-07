<?php

class site {
    public $sb;
    public $db;

    function __construct() {
        global $sb;
        global $db;
        $this->sb = $sb;
        $this->db = $db;
    }

    public function sayfaisle($gelen) {
        while($item = explode('{{', $gelen, 2)) {
            if(count($item) < 2) {
                echo $item[0];
                break;
            }
            echo $item[0];
            $item = explode('}}', $item[1], 2);
            $gelen = $item[1];
            $this->calistir($item[0]);
        }
    }

    private function calistir($gelen) {
        $gelen = explode('(', current(explode(')', $gelen)));
        $func = $gelen[0];
        $param = explode(',', $gelen[1]);
        
        switch($func) {
            case 'sitebilgi':
                echo $this->sitebilgi($param[0]);
                break;
        }
    }

    public function sitebilgi($alan) {
        return $this->sb[$alan];
    }
}
?>