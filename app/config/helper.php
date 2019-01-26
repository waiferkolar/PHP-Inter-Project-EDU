<?php

function beautify($data)
{
    echo "<pre>" . print_r($data, true) . "</pre>";
}

function asset($file)
{
    return BASE_URL . "assets/" . $file;
}

function url($path)
{
    return BASE_URL . $path;
}