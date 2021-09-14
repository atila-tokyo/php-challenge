<?php
namespace Src\Controller;

use Src\Service\AddressService;

class AddressController {


    private $__requestMethod;
    private $__address;

    private $__addressService;

    public function __construct($requestMethod, $address)
    {
        $this->__requestMethod = $requestMethod;
        $this->__address = $address;

        $this->__addressService = new AddressService();
    }

    public function ProcessRequest()
    {
        try{
            switch ($this->requestMethod) {
                case 'GET':
                    $result = $this->__addressService->get__address($this__address);
                    $response['status_code_reader'] = 'HTTP/1.1 200 OK';
                    $response['body'] = json_encode($result);
                    break;
                default:
                    $response = $this->_notFoundResponse();
                    break;
            }
        } catch (BusinessException $e){
            $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
            $response['body'] = json_encode(
                [
                'error' => $e
                ]
            );            
        } catch (Exception $e){
            $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
            $response['body'] = json_encode(
                [
                'error' => $e
                ]
            );
        }
        header($response['status_code_header']);

    }

    private function _notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}