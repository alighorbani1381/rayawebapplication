<?php

use Illuminate\Support\Facades\Gate;

# ACL Check Class use to 
class ACL
{

    # Check Users Access
    static function getUsers()
    {
        return (Gate::allows('Index-User') || Gate::allows('Edit-User') || Gate::allows('Delete-User'));
    }

    # Check CostStatic Access
    static function getCostStatic()
    {
        return (Gate::allows('Index-Cost-Static') || Gate::allows('Edit-Cost-Static') || Gate::allows('Delete-Cost-Static') || Gate::allows('Delete-Cost'));
    }

    # Check Costs Access
    static function getCosts()
    {
        return (Gate::allows('Index-Cost') || Gate::allows('Show-Cost') || Gate::allows('Edit-Cost') || Gate::allows('Delete-Cost'));
    }

    # Check Earnings Access
    static function getEarnings()
    {
        return (Gate::allows('Index-Earning') || Gate::allows('Show-Earning') || Gate::allows('Edit-Earning') || Gate::allows('Delete-Earning'));
    }

    # Check Project Access
    static function getProjects()
    {
        return (Gate::allows('Index-Project') || Gate::allows('Create-Earning-Project') || Gate::allows('Show-Project') || Gate::allows('Edit-Project') || Gate::allows('Delete-Project'));
    }

    # Check Categories Access
    static function getCategories()
    {
        return (Gate::allows('Index-Category') || Gate::allows('Edit-Category') || Gate::allows('Delete-Category'));
    }
}

# Helper method to Check @reurn collection
function hasMember($collection)
{
    return is_countable($collection) && count($collection) != 0;
}

# Show Default Message When Don't Exists Record
function recordMessage($message = 'موردی جهت نمایش یافت نشد.')
{
    $part1 = '<div class="col-lg-offset-2"><img class="exists-record" src="' . asset('admin/images/symbols/cherry.png') . '" alt="record Not Found!"><div class="notfound-content"><div class="notfound-header">';
    $part2 = '<h3 class="exists-record-message">' . $message . '.</h3>';
    $part3 = '</div><div class="notfound-body"></div></div></div>';
    $finalMessage = $part1 . $part2 . $part3;
    return $finalMessage;
}

# URL Generator get picture name and fixed URL
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

# TR Fixed Method in Loop
function openTr($key, $row)
{
    return ($key % $row == 0);
}

function closeTr($key, $row)
{
    $row *= 2;
    $key + 1 % $row == 0;
}

# Get Status Color (use for Progress bar)
function getStatusColor(int $percent)
{
    $color = "";
    if ($percent < 25) $color = "danger";
    if ($percent >= 25 && $percent < 50) $color = "warning";
    if ($percent >= 50 && $percent < 75) $color = "info";
    if ($percent >= 75 && $percent <= 100) $color = "success";
    return $color;
}
