<?php 
session_start();

if (!isset($_SESSION['login']))
{
    header("Location: login.php?erro=lgnNaoRealizado");
}
else if ($_SESSION['login'] == false)
{
    header("Location: login.php?erro=lgnInvalido");
}
?>