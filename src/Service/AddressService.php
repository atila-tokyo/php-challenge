<?php
namespace Src\Service;

use GuzzleHttp\Client;
use Src\Repository\AddressRepository;
use Src\Exception\BusinessException;

class AddressService
{

    private $__repository = null;

    public function __construct()
    {
        $this->__repository = new AddressRepository();
    }

    public function findAll()
    {
        return $this->__repository->findAll();
    }

    public function find($id)
    {
        return $this->__repository->find($id);
    }

    public function getAddress($input)
    {        
        $results = $this->__repository->findAddress($input);
        
        if (empty($results)) {
            $cep = $input['cep'];
            $response = $this->_callViaCepAPI($cep);            
            $this->insert($response);
            $results = $this->__repository->findAddress($input);                        
            
        } 
        return $results[0];
    }

    public function insert(Array $input)
    {
        if (! $this->_validateAddress($input)) {
            throw new BusinessException('Existem campos incompletos.');
        }        
        $this->__repository->insert($input);
    }

    public function update($id, Array $input)
    {
        $result = $this->__repository->find($id);
        if (! $result) {
            throw new BusinessException('Endereço não encontrado.');
        }
        $input = (array) json_decode(file_get_contents('php://input'), true);
        if (! $this->_validateAddress($input)) {
            throw new BusinessException('Existem campos incompletos.');
        }
        $this->__repository->update($id, $input);
    }

    public function delete($id)
    {
        $result = $this->addressService->find($id);
        if (! $result) {
            throw new BusinessException('Endereço não encontrado.');
        }
        $this->__repository->delete($id);
    }

    private function _validateAddress($input)
    {
        if (! isset($input['cep'])) {
            return false;
        }        
        return true;
    }

    private function _callViaCepAPI($data)
    {        
        $cep = str_replace(array("-"), "", $data);   
        
        $client = new Client(['base_uri' => 'https://viacep.com.br/']);
        $response = $client->request('GET', "/ws/$cep/xml");
        $body = $response->getBody()->getContents();
        
        $encode_response = json_encode(simplexml_load_string($body));   
        $decode_response = json_decode($encode_response, true);
        
        return $decode_response;
    }
}
