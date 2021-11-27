<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title> Crypto </title>
    </head>
    <body>
        <p>la plus grosse croissance est de {{ $maxGrowth }} % pour la crypto {{ $maxName }} qui a une valeur actuel de {{ $maxValue }}$</p>
    </body>
</html>