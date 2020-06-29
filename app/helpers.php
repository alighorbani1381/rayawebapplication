<?php

function hasMember($collection)
{
    return is_countable($collection) && count($collection) != 0;
}

function recordMessage($message = 'موردی جهت نمایش یافت نشد.')
{
    $part1 = '<div class="col-lg-offset-2"><img class="exists-record" src="' . asset('admin/images/symbols/cherry.png') . '" alt="record Not Found!"><div class="notfound-content"><div class="notfound-header">';
    $part2 = '<h3>' . $message . '.</h3>';
    $part3 = '</div><div class="notfound-body"></div></div></div>';
    $finalMessage = $part1 . $part2 . $part3;
    return $finalMessage;
}

function showPicture($type, $name)
{
    $type = strtolower($type);

    switch ($type) {
        case 'user.profile':
            $path = asset('profiles/users') . '/' . $name;
            return $path;
            break;

        default:
            return asset("admin/images/users/default.png");
            break;
    }
}
