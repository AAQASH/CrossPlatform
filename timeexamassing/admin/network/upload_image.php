<?php
	function saveUserImage($name, $ID, $is_default, $obj){
		global $file, $upload, $db;		
		if( (int)$ID > 0 ){
			$file->make_dir(ABSPATH.'/uploads/user/'.$ID);
			$file->make_dir(ABSPATH.'/uploads/user/'.$ID."/small");
			$file->make_dir(ABSPATH.'/uploads/user/'.$ID."/medium");
			$file->make_dir(ABSPATH.'/uploads/user/'.$ID."/large");
			
			$file_name = time() ."_". $_FILES[$name]['name'];
			/* START IMAGE UPLOADING */
			$upload->set_max_size(1018463000);
			$upload->set_directory(ABSPATH."/uploads/user/".$ID);
			$upload->set_tmp_name($_FILES[$name]['tmp_name']);
			$upload->set_file_size($_FILES[$name]['size']);
			$upload->set_file_type($_FILES[$name]['type']);
			$upload->set_file_name($file_name);
			$upload->start_copy();
			$userimage = $upload->user_file_name;
			
			/* START IMAGE RESIZING */
			$upload->set_directory(ABSPATH."/uploads/user/".$ID."/small");
			$upload->set_thumbnail_name($file_name);
			$upload->create_thumbnail();
			$upload->set_thumbnail_size(100, 100);
			$image_1 = $upload->thumbnail;
			
			/* START IMAGE RESIZING */
			$upload->set_directory(ABSPATH."/uploads/user/".$ID."/medium");
			$upload->set_thumbnail_name($file_name);
			$upload->create_thumbnail();
			$upload->set_thumbnail_size(200, 200);
			$image_1 = $upload->thumbnail;
			
			/* START IMAGE RESIZING */
			$upload->set_directory(ABSPATH."/uploads/user/".$ID."/large");
			$upload->set_thumbnail_name($file_name);
			$upload->create_thumbnail();
			$upload->set_thumbnail_size(300, 300);
			$image_1 = $upload->thumbnail;
			
			$data["userimage"] = $upload->user_file_name;
			$where["UID = ?"] = $ID;
			$db->update('mts_user', $data, $where);
		}
	}//end function