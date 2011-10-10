<?php
/****************************************************
[*]  XenForo Addon: RecentStatus v4.0.0
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
