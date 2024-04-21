<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function xaAddLike($cid)
{
    $db = Typecho_Db::get();
    $exist = $db->fetchRow($db->select('int_value')->from('table.fields')->where('cid = ? AND name = ?', $cid, 'likeNum'));
    $like = array('cid'=>$cid, 'name'=>'likeNum', 'type'=>'int', 'str_value'=>NULL, 'int_value'=>1, 'float_value'=>0);
    $result = null;
    if (empty($exist)) {
        $result = $db->query($db->insert('table.fields')->rows($like));
    } else {
        $like['int_value'] = $exist['int_value'] + 1;
        $result = $db->query($db->update('table.fields')->rows($like)->where('cid = ? AND name = ?', $cid, 'likeNum'));
    }

    if($result){
        $cookie = Typecho_Cookie::get("__xa_like_cids");
        $cids = null;
        if($cookie){
            $cids = Json::decode($cookie, true);
            $cids[$cid] = 1;
        }else{
            $cids = array($cid=>1);
        }
        Typecho_Cookie::set("__xa_like_cids", Json::encode($cids));
        return true;
    }
    return false;
}

function xaReduceLike($cid)
{
    $db = Typecho_Db::get();
    $exist = $db->fetchRow($db->select('int_value')->from('table.fields')->where('cid = ? AND name = ?', $cid, 'likeNum'));
    $like = array('cid'=>$cid, 'name'=>'likeNum', 'type'=>'int', 'str_value'=>NULL, 'int_value'=>1, 'float_value'=>0);
    if ($exist && $exist['int_value'] > 0) {
        $cookie = Typecho_Cookie::get("__xa_like_cids");
        if($cookie){
            $cids = Json::decode($cookie, true);
            $cids[$cid] = 0;
            $like['int_value'] = $exist['int_value'] - 1;
            $result = $db->query($db->update('table.fields')->rows($like)->where('cid = ? AND name = ?', $cid, 'likeNum'));
            //重新写入
            Typecho_Cookie::set("__xa_like_cids", Json::encode($cids));
            return true;
        }
    }
    return false;
}

function xaGetLikeExistAndNum($cid)
{
    $db = Typecho_Db::get();
    $exist = $db->fetchRow($db->select('int_value')->from('table.fields')->where('cid = ? AND name = ?', $cid, 'likeNum'));
    $cookie = Typecho_Cookie::get("__xa_like_cids");
    if (empty($exist)) {
        return [
            "exist"=>false,
            "num"=>0
        ];
    }else{
        $cids = Json::decode($cookie, true);
        if($exist['int_value'] > 0) {
            return [
                "exist" => $cids[$cid] ? true : false,
                "num" => $exist['int_value']
            ];
        }
        else {
            return [
                "exist" => false,
                "num" => 0
            ];
        }
    }
}