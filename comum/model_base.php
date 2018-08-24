<?php
class ModelBase
{
     public function __construct()
    {
    }
     public function setPost($post)
    {
        foreach($post as $chave => $valor) {
            $this->{$chave} = $valor;
        }
    }
}
?>