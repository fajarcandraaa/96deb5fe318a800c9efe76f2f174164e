<?php
// require ''
namespace Src\Controller;

use Src\Model\MailModel;
use Pkg\Mail\MailSender;
use Pkg\Oauth\OAuth2Authenticator;

class MailController {
    private $db;
    private $requestMethod;
    private $clientId;
    private $cientSecret;
    private $callbackUri;
    private $tokenUri;
    private $mailModel;
    
    public function __construct($db, $requestMethod, $clientId, $clientSecret, $callbackUri, $tokenUri)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->mailModel = new MailModel($db);
        
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->callbackUri = $callbackUri;
        $this->tokenUri = $tokenUri;
    }

    public function processRequest() {
        switch ($this->requestMethod) {
            case 'GET':
                return $response = $this->list();
            case 'POST';
                return $response = $this->sendMail();            
            default:
                return $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function list() {
        $result = $this->mailModel->getList();
        http_response_code(404); 
        echo json_encode($result);
        return;
    }

    private function validate($input)
    {
        if (! isset($input['receiver_mail'])) {
            return false;
        }
        if (! isset($input['subject_mail'])) {
            return false;
        }
        if (! isset($input['message'])) {
            return false;
        }
        return true;
    }

    private function sendMail() {
        $payload = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validate($payload)) {
            $response = [
                'error' => 'Not Found',
            ];
            http_response_code(404); 
            echo json_encode($response);
            return;
        }


        $to = $payload['receiver_mail'];
        $subject = $payload['subject_mail'];
        $message = $payload['message'];

        $emailSender = new MailSender();
        if ($emailSender->send($to, $subject, $message)) {
            $this->mailModel->insertMail($payload);
            $response = [
                'data' => 'Successfully Send Email',
            ];
            http_response_code(201);
        } else {
            $this->mailModel->insertMail($payload);
            $response = [
                'data' => 'Failed to Send Email',
            ];
            http_response_code(502);
        }

        echo json_encode($response);
        return;
    }

    private function notFoundResponse()
    {
        $this->mailModel->insertMail($payload);
        $response = [
            'data' => 'Failed to Send Email',
        ];
        http_response_code(502);
        echo json_encode($response);
        return;
    }
}