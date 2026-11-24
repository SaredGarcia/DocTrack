<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group='default';
$query_builder=TRUE;
$db['default']=array(
 'dsn'=>'','hostname'=>getenv('DB_HOST') ?: '127.0.0.1',
 'username'=>getenv('DB_USER') ?: 'root','password'=>getenv('DB_PASSWORD') ?: '',
 'database'=>getenv('DB_NAME') ?: 'doctrack','dbdriver'=>'mysqli','dbprefix'=>'',
 'pconnect'=>FALSE,'db_debug'=>(ENVIRONMENT!=='production'),'cache_on'=>FALSE,'cachedir'=>'',
 'char_set'=>'utf8mb4','dbcollat'=>'utf8mb4_unicode_ci','swap_pre'=>'','encrypt'=>FALSE,
 'compress'=>FALSE,'stricton'=>TRUE,'failover'=>array(),'save_queries'=>(ENVIRONMENT!=='production')
);