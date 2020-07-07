<?php

use Illuminate\Support\Facades\Gate;

class ACL{

    static function getUsers()
    {
        return ( Gate::allows('Index-User') || Gate::allows('Edit-User') || Gate::allows('Delete-User'));
    }

    static function getCostStatic()
    {
        return ( Gate::allows('Index-Cost-Static') || Gate::allows('Edit-Cost-Static') || Gate::allows('Delete-Cost-Static') || Gate::allows('Delete-Cost'));
    }

    static function getCosts()
    {
        return ( Gate::allows('Index-Cost') || Gate::allows('Show-Cost') || Gate::allows('Edit-Cost') || Gate::allows('Delete-Cost'));
    }

    static function getEarnings()
    {
        return ( Gate::allows('Index-Earning') || Gate::allows('Show-Earning') || Gate::allows('Edit-Earning') || Gate::allows('Delete-Earning'));
    }

    static function getProjects()
    {
        return  ( Gate::allows('Index-Project') || Gate::allows('Create-Earning-Project') || Gate::allows('Show-Project') || Gate::allows('Edit-Project') || Gate::allows('Delete-Project') );        
    }

    static function getCategories()
    {
        return ( Gate::allows('Index-Category') || Gate::allows('Edit-Category') || Gate::allows('Delete-Category'));
    }

}

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

            case 'admin.profile':
                $path = asset('profiles/admins') . '/' . $name;
                return $path;
            break;

            case 'contract.image':
                $path = asset('admin/images/projects/contracts') . '/' . $name;
                return $path;
            break;

            case 'meli.image':
                $path = asset('admin/images/projects/meli_code') . '/' . $name;
                return $path;
            break;
            
        default:
            return asset("admin/images/users/default.png");
            break;
    }
}
