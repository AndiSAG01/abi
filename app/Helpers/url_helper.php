<?php

function set_active($uri)
{
    return ($_SERVER['REQUEST_URI'] == $uri) ? 'active' : '';
}
