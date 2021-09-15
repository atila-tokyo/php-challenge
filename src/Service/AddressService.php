<?php
namespace Src\Service;

use GuzzleHttp\Client;
use Src\Repository\AddressRepository;
use Src\Exception;

class AddressService
{

    private $__repository = null;

    public function __construct()
    {
        $this->__repository = new AddressRepository($dbConnection);
    }

    public function findAll()
    {
        return $this->__repository->findAll();
    }

    public function find($id)
    {
        return $this->__repository->find($id);
    }

    public function getAddress($address)
    {
        $results = $this->findAdress();
        if (empty($results)) {
            $response = $this->_callViaCepAPI($address);
            $results = $response;
            foreach ($item as $response) {
                $this->insert($item);
            }
        }
        return $results;
    }

    public function insert(Array $input)
    {
        if (! $this->_validateAddress($input)) {
            throw new BusinessException('Missing required fields.');
        }
        $this->__repository->insert($input);
    }

    public function update($id, Array $input)
    {
        $result = $this->__repository->find($id);
        if (! $result) {
            throw new BusinessException('Address not found.');
        }
        $input = (array) json_decode(file_get_contents('php://input'), true);
        if (! $this->_validateAddress($input)) {
            throw new BusinessException('Missing required fields.');
        }
        $this->__repository->update($id, $input);
    }

    public function delete($id)
    {
        $result = $this->addressService->find($id);
        if (! $result) {
            throw new BusinessException('Address not found.');
        }
        $this->__repository->delete($id);
    }

    private function _validateAddress($input)
    {
        if (! isset($input['cep'])) {
            return false;
        }
        if (! isset($input['logradouro'])) {
            return false;
        }
        return true;
    }

    private function _callViaCepAPI($address)
    {
        $client = new Client(['base_uri' => 'https://viacep.com.br/']);
        $response = $client->request('GET', "/ws/$address/xml");
        $body = $response->getBody()->getContents();
        
        $encode_response = json_encode(simplexml_load_string($body));   
        $decode_response = json_decode($encode_response, true);
        
        return $decode_response;
    }
}
