<?php

class Dispositivo extends Model {
    protected static $tableName = "dispositivos";
    protected static $columns = [
        'id_dispositivo',
        'nome_dispositivo',
        'modelo_dispositivo',
        'descricao',
        'pino_arduino',
        'id_tipo_dispositivo',
        'id_zona'
    ];

    public static function getTipoDispositivo() {
        $objects = [];
        $result = static::getResultTipoDispositivo();
        if($result) {
            $class = get_called_class();
            while ($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getResultTipoDispositivo(){
        $sql = 'SELECT * FROM tiposdispositivos';
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0) {
            return null;
        } else {
            return $result;
        }
    }

    public function inserir() {
        $this->validar();
        if(!$this->descricao) $this->descricao = null;
        return parent::insert();
    }

    public function alterar() {
        $this->validar();
        if(!$this->descricao) $this->descricao = null;
        return parent::update();
    }
        
    public static function deleteByIdDipositivo($id) {
        $sql = "DELETE FROM " . static::$tableName . " WHERE id_dispositivo = {$id}";
        Database::executeSQL($sql);
    }

    private function validar() {
        $errors = [];

        if(!$this->nome_dispositivo) {
            $errors['nome_dispositivo'] = 'Nome é um campo obrigatório';
        }

        if(!$this->modelo_dispositivo) {
            $errors['modelo_dispositivo'] = 'Modelo é um campo obrigatório';
        }

        if(!$this->id_tipo_dispositivo) {
            $errors['tipo_dispositivo'] = 'Tipo é um campo obrigatório';
        }

        if(!$this->id_zona) {
            $errors['zona'] = 'Zona é um campo obrigatório';
            $errors['jardim'] = 'Jardim é um campo obrigatório';
        }

        if(count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}