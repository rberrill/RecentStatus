<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

class RCBD_RecentStatus_Controller_Public extends XFCP_RCBD_RecentStatus_Controller_Public {

    public function actionIndex() {
        $response = parent::actionIndex();

        if ($response instanceof XenForo_ControllerResponse_View) {
            $xfRecentStatus = RCBD_RecentStatus_Model_StatusList::getStatusArray();
        }

        $response->params += array('xfRecentStatus' => $xfRecentStatus['status']);
        $response->params += array('xfRecentStatusComments' => $xfRecentStatus['comments']);
        return $response;
    }

}

?>
