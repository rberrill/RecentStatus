<?php
/****************************************************
[*]  XenForo Addon: RecentStatus
[*]  http://www.rcbdesigns.net
[*]  Copyright 2011 RCB Designs
[*]  All rights reserved
 ****************************************************/

function getUserData($postData) {
    $userArray = array();
    foreach ($postData as $status) {
        $userArray[] = $status['user_id'];
    }
    $userModel = new Xenforo_Model_User;
    return $userModel->getUsersByIds($userArray);
}

function array_sort($array, $on, $order='SORT_DESC') {
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case 'SORT_ASC':
                asort($sortable_array);
                break;
            case 'SORT_DESC':
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[] = $array[$k];
        }
    }
    return $new_array;
}

class RCBD_RecentStatus_Model_StatusList extends Xenforo_Model_User {

    public static function getStatusArray() {
        $db = XenForo_Application::get('db');
        $userModel = new Xenforo_Model_User;
        $options = XenForo_Application::get('options');
        $numStatusShown = $options->RCBDRecentStatusNumView;
        $showComments = $options->RCBDRecentStatusShowComments;
        $onePerUser = $options->RCBDRecentStatusOnePerUser;
        $data = XenForo_Application::getSimpleCacheData("RCBDRecentStatus_status_array");
        if (!$data) {
            if ($onePerUser == 1) {
                $statusArray = $db->fetchAll($db->limit("SELECT * FROM (SELECT * FROM xf_profile_post WHERE message_state <> 'deleted' AND profile_user_id = user_id ORDER BY post_date DESC) t1 GROUP BY t1.user_id ORDER BY post_date DESC", $numStatusShown));
                $statusArray = array_sort($statusArray, "post_date");
            } else {
                $statusArray = $db->fetchAll($db->limit("SELECT * FROM  xf_profile_post WHERE profile_user_id = user_id AND message_state <> 'deleted' ORDER BY post_date DESC", $numStatusShown));
            }
            XenForo_Application::setSimpleCacheData("RCBDRecentStatus_status_array", $statusArray);
        } else {
            $statusArray = $data;
        }
        $recentStatus = array();
        $postIds = array();
        if (sizeof($statusArray) == 0) {
            $statusArray = array(0 => array("profile_post_id" => 0, "user_id" => 1, "post_date" => time(), "message" => "No status entries yet, be the first!"));
        }
        foreach ($statusArray as $status) {
            $postIds[] = $status['profile_post_id'];
        }
        $commentsArray = array();
        $commentsSortedArray = array();
        if ($showComments == 1) {
            $matches = implode(',', $postIds);
            $data = XenForo_Application::getSimpleCacheData("RCBDRecentStatus_comments_array");
            if (!$data) {
                $commentsArray = $db->fetchAll($db->limit("SELECT * FROM  xf_profile_post_comment WHERE profile_post_id in(" . $matches . ") ORDER BY profile_post_id DESC, comment_date", $numStatusShown));
                XenForo_Application::setSimpleCacheData("RCBDRecentStatus_comments_array", $commentsArray);
            } else {
                $commentsArray = $data;
            }
            $commentsUserObjs = getUserData($commentsArray);
            $currentPostId = -99;
            $commentGroup = array();
            foreach ($commentsArray as $status) {
                if ($currentPostId != $status['profile_post_id']) {
                    if ($currentPostId != -99) {
                        $commentsSortedArray[$currentPostId] = $commentGroup;
                        $commentGroup = array();
                    }
                    $currentPostId = $status['profile_post_id'];
                }
                $commentGroup[] = array("user" => $commentsUserObjs[$status['user_id']], "status" => $status['message'], "time" => $status['comment_date'], "post_id" => $status['profile_post_id']);
            }
            $commentsSortedArray[$currentPostId] = $commentGroup;
        }
        $statusUserObjs = getUserData($statusArray);
        foreach ($statusArray as $status) {
            $recentStatus[] = array("user" => $statusUserObjs[$status['user_id']], "status" => $status['message'], "time" => $status['post_date'], "post_id" => $status['profile_post_id']);
        }
        $returnArrays = array("status" => $recentStatus, "comments" => $commentsSortedArray);
        return $returnArrays;
    }

}
