<?php

class Jardim extends Model {
    protected static $tableName = "jardins";
    protected static $columns = [
        'id',
        'nome_jardim',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'tamanho',
        'descricao_jardim'
    ];

    public function inserir() {
        $this->validar();
        if(!$this->descricao_jardim) $this->descricao_jardim = null;
        return parent::insert();
    }

    public function alterar() {
        $this->validar();
        if(!$this->descricao_jardim) $this->descricao_jardim = null;
        return parent::update();
    }

    private function validar() {
        $errors = [];

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

    public static function getZonas($id) {
        return static::getCount(['raw' => "id = {$id}"]);
    }
}