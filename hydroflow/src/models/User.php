<?php

class User extends Model {

    protected static $tableName = "usuarios";
    protected static $columns = [
        'idUsuario',
        'usuario',
        'senha'
    ];
}