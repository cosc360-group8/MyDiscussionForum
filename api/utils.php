<?php

function timesince($datetime){
    $now = strtotime("now");
    $then = strtotime($datetime);
    // Number of seconds since the post
    $delta = $now - $then;
    $retstr = '';

    $min = getminutes($delta);
    $hr = gethours($delta);
    $dys = getdays($delta);
    $yrs = getyears($delta);

    if ($min == 0){
        $retstr = $delta.' second';
        if ($delta != 1){
            $retstr = $retstr.'s';
        }
        $retstr = $retstr.' ago';
    } else if ($hr == 0){
        $retstr = $min.' minute';
        if ($min != 1){
            $retstr = $retstr.'s';
        }
        $retstr = $retstr.' ago';
    } else if ($dys == 0){
        $retstr = $hr.' hour';
        if ($hr != 1){
            $retstr = $retstr.'s';
        }
        $retstr = $retstr.' ago';
    } else if ($yrs == 0){
        $retstr = $dys.' day';
        if ($dys != 1){
            $retstr = $retstr.'s';
        }
        $retstr = $retstr.' ago';
    } else {
        $retstr = $yrs.' year';
        if ($yrs != 1){
            $retstr = $retstr.'s';
        }
        $retstr = $retstr.' ago';
    }
    return $retstr;
}

function requireAdmin($user, $redirect){
    requireLogin($user, $redirect);
    if (isset($user) && $user->admin == 1){
        return;
    }
    header('Location: ' . $redirect);
}

function requireLogin($user, $redirect){
    if (isset($user) && $user->enabled == 1){
        return;
    }
    header('Location: '. $redirect);
}

function getminutes($secs){
    return floor($secs / 60.0);
}

function gethours($secs){
    return floor($secs / 3600.0);
}

function getdays($secs){
    return floor($secs / 86400.0);
}

function getyears($secs){
    return floor($secs / 31536000.0);
}

?>