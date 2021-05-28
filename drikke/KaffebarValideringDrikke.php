<?php
class KaffebarValideringDrikke 
{
    private $errors = [];
    private $data;

    private static $fields = ['drikkevare', 'drikkepris'];

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

        $this->validerDrikkevare();
        $this->validerPris();
        return $this->errors;
    }

    private function validerDrikkevare(){

        $val = trim($this->data['drikkevare']);

        if(empty($val)){
            $this->addError('drikkevare', 'drikkevare kan ikke være tom');
        }
    }

    private function validerPris(){
        $val = trim($this->data['drikkepris']);

        if(empty($val)){
            $this->addError('drikkepris', 'drikkepris kan ikke være tom');
        }
    }

    private function addError($key, $val){
        $this->errors[$key] = $val;
    }

}


?>