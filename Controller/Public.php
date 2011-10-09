<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.snlponline.net
[*]  Copyright 2010 snlponline.net
[*]  All rights reserved
 ****************************************************/

 class RecentStatus_Controller_Public extends XFCP_RecentStatus_Controller_Public
{
	public function actionIndex()
	{
		$response = parent::actionIndex();
		
		if ($response instanceof XenForo_ControllerResponse_View)
		{
			$xfRecentStatus = RecentStatus_Model_StatusList::getStatusArray();
		}
		
		$response->params += array('xfRecentStatus' => $xfRecentStatus['status']);
		$response->params += array('xfRecentStatusComments' => $xfRecentStatus['comments']);
		return $response;
	}
}
?>
