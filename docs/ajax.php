<?php 

class GoogleDoc
{

    public function __construct()
    {   
        $this->create_doc();
    }

    private function create_doc()
    {
        $data = [
            "access_token" => "",
            "document" =>[
                "documentId" => "1",
                "title" => "peoples"
            ],  
        ];


        $options = array(
            'http' => array(
                'header'  => 'Content-type: application/json',
                'method'  => '',
                'content' => json_encode($data , JSON_FORCE_OBJECT)
            )
        );

        $context  = stream_context_create($options);

        $res = file_get_contents('https://docs.googleapis.com/v1/documents' , false , $context);
        return $res; 
    }
}

var_dump(new GoogleDoc());