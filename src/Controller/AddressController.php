<?php
namespace Src\Controller;

use Exception;
use Src\Service\AddressService;
use Src\Exception\BusinessException;

class AddressController 
{
    private $__errors = null;
    private $__errorMessage = null;

    private $__addressService;

    public function __construct()
    {
        $this->__addressService = new AddressService();
    }

   
    public function handleSearch()
    {        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $input = [
                'cep' => $_POST['cep']
            ];

            $this->validateSearchForm($input);
            if ($this->__errors) {
                $viewData = [
                    'input' => $input,
                    'errors' => $this->__errors,
                    'errorMessage' => $this->__errorMessage
                ];
                view('home', $viewData);
                return true;
            }
            try{
                $result = $this->__addressService->getAddress($input);
                $viewData = [
                    'input' => $input,
                    'result' => $result
                ];
                view('home', $viewData);                
            } catch (BusinessException $e){
                $viewData = [
                    'input' => $input,
                    'errors' => true,
                    'errorMessage' => $e->getMessage()
                ];
                view('home', $viewData);
                return true;                          
            } catch (Exception $e){
                $viewData = [
                    'input' => $input,
                    'errors' => true,
                    'errorMessage' => "Server Error."
                ];
                view('home', $viewData);
                return true;
                
            }
            return true;
        }
        header('HTTP/1.0 405 Method Not Allowed');
        die();
    }

    private function validateSearchForm($input)
    {
        $errorMessage = '';
        $errors = false;

        // validate field lengths
        if (empty($input['cep'])) {
            $errorMessage .= "<br>'CEP' é necessário!";
            $errors = true;            
        }        

        $this->__errors = $errors;
        $this->__errorMessage = $errorMessage;
    }
    
}