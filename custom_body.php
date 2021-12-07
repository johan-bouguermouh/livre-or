<?php
if(!empty($_SESSION['color_body']))
{
    $color_body = $_SESSION['color_body'];
}
else
{
    $color_body = '#18898c';
}
if(!empty($_SESSION['color_head']))
{
    $color_head = $_SESSION['color_head'];
}
else
{
    $color_head = '#ffffff';
}
?>
<style>
        body {
            background-color:<?=$color_body?>;
        }
        .user_icon_login{
            background-color:<?=$color_head?>;
        }
</style>

