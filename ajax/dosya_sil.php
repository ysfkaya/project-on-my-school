<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    	if (isPost() && isAjax()){
    		$array = array();
    		$id = post('key');

    		$dosya = $db->query("SELECT * FROM dosyalar WHERE dosya_id = $id")->fetch(PDO::FETCH_ASSOC);


    		if (is_file($dosya['dosya_yol'])) {
    			$sil = unlink($dosya['dosya_yol']);
    			if ($sil) {
    				$sonuc = $db->query("DELETE FROM dosyalar WHERE dosya_id = $id");
                    if ($sonuc) {
                        olay(array("Dosya Silindi","dosya-sil"),null,getSession('id'));
                    }
    			}else{
    				$array['error'] = 'Dosya silinemedi';
    			}
    		}else{
    			$array['error'] = 'Dosya yolu bulanamadı';
    		}



	        echo json_encode($array);
    	}

