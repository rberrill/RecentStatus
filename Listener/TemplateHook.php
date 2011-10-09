<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.snlponline.net
[*]  Copyright 2010 snlponline.net
[*]  All rights reserved
 ****************************************************/

class RecentStatus_Listener_TemplateHook
{
	public static function template_hook($name, &$contents, array $params, XenForo_Template_Abstract $template)
	{
		// Choose the hook you want to manipulate
		if ($name === 'forum_list_sidebar')
		{
			// Change the value of $contents in any way you want
			$xfRecentStatus = RecentStatus_Model_StatusList::getStatusArray();
			$params = array('xfRecentStatus' => $xfRecentStatus['status'],
							'xfRecentStatusComments' => $xfRecentStatus['comments'],
							'visitor' => XenForo_Visitor::getInstance(),
							);
			
			$contents .= $template->create('recent_status',$params)->render();
		}
	}
}

?>