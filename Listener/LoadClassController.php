<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

class RCBD_RecentStatus_Listener_LoadClassController
{
    public static function listen($class, array &$extend)
    {
        if ($class == 'XenForo_ControllerPublic_Index')
        {
            $extend[] = 'RCBD_RecentStatus_Controller_Public';
        }
    }
}

?>