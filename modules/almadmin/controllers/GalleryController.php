<?php

namespace admin\controllers;

use admin\controllers\AppAdminController;



class GalleryController extends AppAdminController
{

    public function action()
    {
        
        if ( isset( $this->params['remove'] ) )
        {
            $name = $this->post['name'];
            $folder = $this->post['folder'];
            //debug($this->params);
            //debug($this->post,'post',1);
            $arr['ok'] = $this->deleteImg($name, $folder);
            
            echo json_encode($arr);
            exit;
        }
        
        function readFiles($path)
        {
            $res = [];
            $dir = opendir($path);
            while( $file = readdir($dir) )
            {
                if( $file == '.' || $file == '..' || is_dir( $stockDir . "/" . $file) || $file == 'default.png' || $file == 'stock_dummy.png' )
                {
                    continue;
                }
                $res[]["name"] = $file;
            }
            return $res;
        }
        
        $stockFiles = readFiles(_rootDIR_ . "/views/images/stock");
        $shippFiles = readFiles(_rootDIR_ . "/views/images/shipments");
        
        return $this->render('gallery', compact('stockFiles','shippFiles'));
    }
    
    protected function deleteImg($name,$folder)
    {
        if ( empty($name) || empty($folder) ) return null;
        
        $dellFolder = _rootDIR_."/views/images/shipments";
        if ( $folder == 'stock' ) $dellFolder = _rootDIR_."/views/images/stock";
        
        $file = $dellFolder . "/" . $name;
        
        if ( file_exists($file) ) 
        {
            unlink($file);
            $ok = 1;
        } else {
            $ok = 0;
        }
        
        return $ok;
    }
   
}
