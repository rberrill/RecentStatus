<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

class RCBD_RecentStatus_Controller_ClearCache {

    public static function clear() {
        XenForo_Application::setSimpleCacheData("RCBDRecentStatus_status_array",null);
        XenForo_Application::setSimpleCacheData("RCBDRecentStatus_comments_array",null);
        return true;
    }
}