<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

class RCBD_RecentStatus_Listener_DataWriter {
    public static function listen($class, array &$extend) {
        if($class == "XenForo_DataWriter_DiscussionMessage_ProfilePost") {
            $extend[] = 'RCBD_RecentStatus_DataWriter_ProfilePost';
        }
    }
}
