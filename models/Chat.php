<?php

class Chat
{
    public $id_chat;
    public $user_from;
    public $user_to;
}
interface ChatDao
{
public function insertChat($user_from, $user_to, $user_to_nome, $user_from_nome);
public function existsChat($user_from, $user_to);
}
