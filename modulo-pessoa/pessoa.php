<?php
include "../comum/model_base.php";
class Pessoa extends ModelBase
{
    public $id;
    public $primeiro_nome;
    public $segundo_nome;
    public $email;
    public $cpf;
    public $data_nascimento; // Deve ser um objeto DateTime
    public $endereco;
    public $bairro;
    public $numero;
    public $cep;
    public $tipo;
    public $sexo;
    // Chaves estrangeiras
    public $uf_id;
    public $cidade_id;
    
    public function __construct($pessoaDb=null)
    {
        if ($pessoaDb) {
            $this->id = $pessoaDb->id;
            $this->primeiro_nome = $pessoaDb->primeiro_nome;
            $this->segundo_nome = $pessoaDb->segundo_nome;
            $this->email = $pessoaDb->email;
            $this->cpf = $pessoaDb->cpf;
            $this->endereco = $pessoaDb->endereco;
            $this->bairro = $pessoaDb->bairro;
            $this->numero = $pessoaDb->numero;
            $this->cep = $pessoaDb->cep;
            $this->tipo = $pessoaDb->tipo;
            $this->sexo = $pessoaDb->sexo;
            $this->data_nascimento = DateTime::createFromFormat('Y-m-d H:i:s', $pessoaDb->data_nascimento);
            if ($pessoaDb->uf_id) {
                $this->uf_id = $pessoaDb->uf_id;
            }
            if ($pessoaDb->cidade_id) {
                $this->cidade_id = $pessoaDb->cidade_id;
            }
        }
    }
    public function getCpfFormatado() {        
        $retorno = '';
        if ($this->cpf) {
            $retorno = adicionarMascaraCpf($this->cpf);
        }
        return $retorno;
    }
    public function getDataNascimentoFormatada()
    {
        $retorno = '';
        if ($this->data_nascimento) {
            $retorno = $this->data_nascimento->format('d/m/Y');
        }
        return $retorno;
    }
    public function getNomeCompleto()
    {
        return "{$this->primeiro_nome} {$this->segundo_nome}";
    }
    public function setPost($post) 
    {
        parent::setPost($post);
        if (isset($post['data_nascimento'])) {
            $this->data_nascimento = DateTime::createFromFormat('d/m/Y', $post['data_nascimento']);
        }
        if (isset($post['cpf'])) {
            $this->cpf = removerMascaraCpf($post['cpf']);
        }
        if (isset($post['uf'])) {
            $this->uf_id = $post['uf'];
        }
        if (isset($post['cidade'])) {
            $this->cidade_id = $post['cidade'];
        }
    }
}
?>