<?php
/****************************************************
[*]  XenForo Addon: RecentStatus v4.0.0
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

class RCBD_RecentStatus_DataWriter_ProfilePost extends XFCP_RCBD_RecentStatus_DataWriter_ProfilePost {
    public function save() {
        $response = parent::save();
        XenForo_Application::setSimpleCacheData("RCBDRecentStatus_status_array",null);
        XenForo_Application::setSimpleCacheData("RCBDRecentStatus_comments_array",null);
        return $response;
    }
}