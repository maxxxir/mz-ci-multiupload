# mz-ci-multiupload
a simple library for uploading multiple files at once in codeigniter , usage is pretty much like ci native lib

      $this->load->library('multi_upload');
			$config['upload_path']   =  './path/to/directory/' ;
			$config['allowed_types'] = 'jpg|png|jpeg|JPEG|gif|png';
			$config['max_size']      = 500;
			$res = $this->multi_upload->upload('input_name' , $config );
			
the result would be something like : 

array
(
  'uploaded' =>  1
  'error'    =>  '' 
  'files'    => 
          			0 => 
          			  'name' =>  'testpic.jpg' 
          			  'stat' =>  'ok'  
          			  'size' =>  156.42
          			  'new_name' => '21ce725b3b7613aad8f845c459e9438a.jpg' 
          		   1 => 
          		    'name' => 'upload.php' 
          			  'stat' => 'err' 
          			  'config' =>    ...
          			  'error' =>  'The filetype you are attempting to upload is not allowed.' 
			  )




