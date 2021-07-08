<?php

$chatRoom = $userInfo->id_usuario;
$userConfigs = $auth->userConfigs($userInfo->id_usuario);
$countFollowing = $follow_mid->listFollowingUsers($userInfo->id_usuario);
$countFollowed = $follow_mid->listFollowed($userInfo->id_usuario);

