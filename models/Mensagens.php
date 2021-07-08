<?php

class Mensagens
{
    public $id_mensagens;
    public $user_from;
    public $user_to;
    public $conteudo;
    public $data_mensagem;
    public $hora_mensagem;
    public $id_chat;
}
interface MensagensDao{
    public function getMensagens($user_from, $user_to);
    public function insertMensagens(Mensagens $m);
}