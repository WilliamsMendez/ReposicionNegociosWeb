<?php

namespace Dao\Mnt;

use Dao\Table;

Class Cars extends Table{
    public static function insert(string $placa_carro, string $modelo_carro,string $year_carro,string $bin_carro): int
    {
        $sqlstr = "INSERT INTO car (placa_carro,modelo_carro,year_carro,bin_carro) values(:placa_carro, :modelo_carro, :year_carro, :bin_carro);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("placa_carro"=>$placa_carro, "modelo_carro"=>$modelo_carro, "year_carro"=>$year_carro, "bin_carro"=>$bin_carro)
        );
        return $rowsInserted;
    }
    public static function update(
        string $placa_carro ,
        string $modelo_carro, 
        string $year_carro ,
        string $bin_carro, 
        int $registro_id
    ){
        $sqlstr = "UPDATE car set placa_carro = :placa_carro, modelo_carro = :modelo_carro, year_carro = :year_carro, bin_carro= :bin_carro where registro_id=:registro_id;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "placa_carro" => $placa_carro,
                "modelo_carro" => $modelo_carro,
                "year_carro" => $year_carro,
                "bin_carro" => $bin_carro,
                "registro_id" => $registro_id
            )
        );
        return $rowsUpdated;
    }
    public static function delete(int $registro_id){
        $sqlstr = "DELETE from car where registro_id=:registro_id;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "registro_id" => $registro_id
            )
        );
        return $rowsDeleted;
    }
    public static function findAll(){
        $sqlstr = "SELECT * from car;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function findById(int $registro_id){
        $sqlstr = "SELECT * from car where registro_id = :registro_id;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "registro_id"=> $registro_id
            )
        );
        return $row;
    }
}
?>