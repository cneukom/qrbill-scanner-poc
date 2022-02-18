<?php

function externalize($url)
{
    if (!config('app.url_external')) {
        return $url;
    }

    return str_replace(config('app.url'), config('app.url_external'), $url);
}
