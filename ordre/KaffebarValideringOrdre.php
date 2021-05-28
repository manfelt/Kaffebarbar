<?php
class KaffebarValideringOrdre 
{
    private $errors = [];
    private $data;

    private static $fields = ['ordrevare', 'ordrekvantum'];

    public function __construct($post_data){
        $this->data = $post_data;
    }

    public function validerForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field finnes ikke");
                return;
            }
        }

        $this->validerOrdrevare();
        $this->validerKvantum();
        return $this->errors;
    }

    private function validerOrdrevare(){

        $val = trim($this->data['ordrevare']);

        if(empty($val)){
            $this->addError('ordrevare', 'ordrevare kan ikke være tom');
        }
    }

    private function validerKvantum(){
        $val = trim($this->data['ordrekvantum']);

        if(empty($val)){
            $this->addError('ordrekvantum', 'kvanta kan ikke være tom');
        }
    }

    private function addError($key, $val){
        $this->errors[$key] = $val;
    }

}


?>