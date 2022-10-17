<?php
setcookie('PHPSESSID',null,time()-3600,'/');
header("Location:/");