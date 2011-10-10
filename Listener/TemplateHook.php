<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

class RCBD_RecentStatus_Listener_TemplateHook {

    public static function templateHook($name, &$contents, array $params, XenForo_Template_Abstract $template) {
        // Choose the hook you want to manipulate
        if ($name === 'forum_list_sidebar') {
            // Change the value of $contents in any way you want
            $xfRecentStatus = RCBD_RecentStatus_Model_StatusList::getStatusArray();
            $params = array('xfRecentStatus' => $xfRecentStatus['status'],
                'xfRecentStatusComments' => $xfRecentStatus['comments'],
                'visitor' => XenForo_Visitor::getInstance(),
            );

            $contents .= $template->create('RCBD_recent_status', $params)->render();
        }
    }

    public static function templateCreate($templateName, array &$params, XenForo_Template_Abstract $template) {
        if($templateName == "PAGE_CONTAINER") {
            $template->preloadTemplate("RCBD_recent_status");
        }
    }}

?>