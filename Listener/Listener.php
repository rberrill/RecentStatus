<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.snlponline.net
[*]  Copyright 2010 snlponline.net
[*]  All rights reserved
 ****************************************************/

class RecentStatus_Listener_Listener
{
    public static function listen($class, array &$extend)
    {
        if ($class == 'XenForo_ControllerPublic_Index')
        {
            $extend[] = 'RecentStatus_Controller_Public';
        }
    }
}

?>