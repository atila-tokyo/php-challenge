<?php
namespace Src\Repository;

use Src\Persistence\DatabaseConnector;

class AddressRepository
{

    private $__db = null;

    public function __construct()
    {
        $this->__db = (new DatabaseConnector)->getConnection();
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, 
                cep, 
                logradouro, 
                complemento, 
                bairro, 
                localidade, 
                uf, 
                ibge, 
                gia, 
                ddd, 
                siafi
            FROM
                address;
        ";

        try {
            $statement = $this->__db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        $statement = "
            SELECT 
                id, 
                cep, 
                logradouro, 
                complemento, 
                bairro, 
                localidade, 
                uf, 
                ibge, 
                gia, 
                ddd, 
                siafi
            FROM
                address
            WHERE id = ?;
        ";

        try {
            $statement = $this->__db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function findAddress(Array $input)
    {
        $statement = "
            SELECT 
                id, 
                cep, 
                logradouro, 
                complemento, 
                bairro, 
                localidade, 
                uf, 
                ibge, 
                gia, 
                ddd, 
                siafi
            FROM
                address
            WHERE cep = :cep;
        ";

        try {
            $statement = $this->__db->prepare($statement);
            $statement->execute(
                array(
                'cep' => $input['cep'],                
                )
            );
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function insert(Array $input)
    {        
        $statement = "
            INSERT INTO address 
                (cep, logradouro, complemento, bairro, localidade, 
                uf, ibge, gia, ddd, siafi)
            VALUES
                (:cep, :logradouro, :complemento, :bairro, :localidade, 
                :uf, :ibge, :gia, :ddd, :siafi);
        ";

        try {
            $statement = $this->__db->prepare($statement);
            $statement->execute(
                array(
                ':cep' => $input['cep'],
                ':logradouro'  => is_array($input['logradouro']) ? implode($input['logradouro']) : $input['logradouro'],
                ':complemento' => is_array($input['complemento']) ? implode($input['complemento']) : $input['complemento'],
                ':bairro' => is_array($input['bairro']) ? implode($input['bairro']) : $input['bairro'],
                ':localidade' => $input['localidade'] ?? " ",
                ':uf' => $input['uf'] ?? null,
                ':ibge' => $input['ibge'] ?? null,
                ':gia' => $input['gia'] ?? null,
                ':ddd' => $input['ddd'] ?? null,
                ':siafi' => $input['siafi'] ?? null,
                )
            );
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE address
            SET 
                cep = :cep,
                logradouro  = :logradouro,
                complemento = :complemento,
                localidade = :localidade,
                uf = :uf,
                ibge = :ibge,
                gia = :gia,
                ddd = :ddd,
                siafi = :siafi,                
            WHERE id = :id;
        ";

        try {
            $statement = $this->__db->prepare($statement);
            $statement->execute(
                array(
                'id' => (int) $id,
                'cep' => $input['cep'],
                'logradouro'  => $input['logradouro'],
                'complemento' => $input['complemento'],
                'localidade' => $input['localidade'],
                'uf' => $input['uf'],
                'ibge' => $input['ibge'],
                'gia' => $input['gia'],
                'ddd' => $input['ddd'],
                'siafi' => $input['siafi'],
                )
            );
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM address
            WHERE id = :id;
        ";

        try {
            $statement = $this->__db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }
}