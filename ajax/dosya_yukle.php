<?php 
    require '../system/database.php';
    require '../system/system.php';
    require '../system/frontend.php';

    	if (isPost() && isAjax()){
            $dosya = $_FILES['proje_dosya'];
            $id = post('id');

	        $sorgu = $db->prepare("SELECT proje_dosya FROM projeler WHERE proje_id = :id");
	        $sorgu->execute(array(
	        	'id' => $id
	        	));
	        $satır = $sorgu->fetch(PDO::FETCH_ASSOC);
	        $yol = $satır['proje_dosya'];
	        $paths = $link = $uzantılar = $adlar = $boyutlar = $last_id = $p = $p2 = array();
	        $array['yol'] = is_dir($yol);
	        if (is_dir($yol)) {
                $success = false;
                $array['dosya'] = $dosya['name'];
                for($i=0; $i < count($dosya['name']); $i++){
			        $uzantı = substr($dosya['name'][$i],-4,4);
			        $adı = date('Y-m-d H.i.s').$uzantı;

					$string = $yol;
					$parca = explode('dosyalar\\',$string);
					$parcala2 = explode('\\',$parca[1]);
					$dosya_adı = $parcala2[0];
					$array['dosya_adi'] = $dosya_adı;
			        $url = URL."/dosyalar/".$dosya_adı."/".$adı;
			        $buraya = $yol.DIRECTORY_SEPARATOR.$adı;

                    if(move_uploaded_file($dosya['tmp_name'][$i], $buraya)) {
                        $array['test1'] = "test".$i;
				        $success = true;
				        $link[] = $url;
				        $uzantılar[] = $dosya['type'][$i];
				        $adlar[] = $adı;
				        $boyutlar[] = $dosya['size'][$i];
				        $paths[] = $buraya;

				    } else {
				        $success = false;
				        break;
				    }
				}

				if ($success === true) {
				    $durum = false;
					for ($i=0; $i < count($paths); $i++) {
						$ekle = $db->prepare("INSERT INTO dosyalar SET
							proje_id = :id,
							dosya_ad = :ad,
							dosya_uzantı =:uzanti,
							dosya_yol = :yol,
							dosya_link = :link,
							dosya_boyut = :boyut
							");
						$sonuc = $ekle->execute(array(
							'id' => $id,
							'ad' => $adlar[$i],
							'uzanti' => $uzantılar[$i],
							'yol' => $paths[$i],
							'link' => $link[$i],
							'boyut' => $boyutlar[$i]
							));
						if ($sonuc) {
							$durum = true;
							$last_id[] = $db->lastInsertId();
							olay(array("Dosya Yüklendi","dosya-yukle"),$id,getSession('id'),null,$db->lastInsertId());
						}else{
							$durum = $db->errorInfo()[2];
							break;
						}
					}

					if ($durum === true) {
						for ($i=0; $i < count($last_id); $i++) {
							$zip = $db->query("SELECT * FROM dosyalar WHERE dosya_id = $last_id[$i]")->fetch(PDO::FETCH_ASSOC);
							$ad = $zip['dosya_ad'];
							$p[$i] = $zip['dosya_link'];
    						$p2[$i] = ['caption' => "$ad", 'size' => $zip['dosya_boyut'], 'width' => '120px', 'url' => $zip['dosya_link'], 'key' => $zip['dosya_id']];
						}
						$array['initialPreview'] = $p;
						$array['initialPreviewConfig'] = $p2;
						$array['append'] = true;
					}else{
						$array['error'] = "Veri tabanına kayıt başarısız. ".$durum;
					}
				}else{
					$array['error'] = 'Yükleme sırasında hata oluştu. Site yöneticisi ile iletişime geçiniz';
				    foreach ($paths as $file) {
				        unlink($file);
				    }
				}
	        }else{
	        	$array['error'] = 'Dosya yolu bulunamadı!';
	        }



	        echo json_encode($array);
    	}else{
    	    die("Geçersiz istek");
    	}

