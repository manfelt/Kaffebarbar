<?php
class KaffebarValideringTillegg
{
    private $errors = [];
    private $data;

    private static $fields = ['tilleggvare', 'tilleggpris'];

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
        $this->validerTilleggvare();
        return $this->errors;
    }

    private function validerTilleggvare(){

        $val = trim($this->data['tilleggvare']);
        if(empty($val)){
            $this->addError('tilleggvare', 'tilleggvare kan ikke være tom');
        }
    }

    private function addError($key, $val){
        $this->errors[$key] = $val;
    }

}


?>