<?php 

class Helpers{
    public function insertOrUpdate(array $rows, $table){

        $first = reset($rows);
    
        $columns = implode( ',',
            array_map( function( $value ) { return "$value"; } , array_keys($first) )
        );
    
        $values = implode( ',', array_map( function( $row ) {
                return '('.implode( ',',
                    array_map( function( $value ) { return '"'.str_replace('"', '""', $value).'"'; } , $row )
                ).')';
            } , $rows )
        );
    
        $updates = implode( ',',
            array_map( function( $value ) { return "$value = VALUES($value)"; } , array_keys($first) )
        );
    
        $sql = "INSERT INTO {$table}({$columns}) VALUES {$values} ON DUPLICATE KEY UPDATE {$updates}";
    
        return $sql;
    }
    
    public function getMonthName($param){
        $tahun = '';
        $len = strlen($param);
        if($len == 5){
            $month = substr($param, 0, 1);
            $tahun = substr($param, 1, 4);
        }else{
            $month = substr($param, 0, 2);
            $tahun = substr($param, 2, 4);
        }
        
        $result = '';
        if($month == 1){
            $result = 'Januari';
        }elseif($month == 2){
            $result = 'Februari';
        }elseif($month == 3){
            $result = 'Maret';
        }elseif($month == 4){
            $result = 'April';
        }elseif($month == 5){
            $result = 'Mei';
        }elseif($month == 6){
            $result = 'Juni';
        }elseif($month == 7){
            $result = 'Juli';
        }elseif($month == 8){
            $result = 'Agustus';
        }elseif($month == 9){
            $result = 'September';
        }elseif($month == 10){
            $result = 'Oktober';
        }elseif($month == 11){
            $result = 'November';
        }elseif($month == 12){
            $result = 'Desember';
        }

        return $result . ' '. $tahun;
    }
}