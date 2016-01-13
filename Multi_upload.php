<?php
      


      class multi_upload{
 
 		public $config = array();
	 
 		public function upload( $fild = 'files'  , $config = array()){


				   $export = array('uploaded'=>0 , 'error'=>'' , 'files'=>array());


			       if(!isset($_FILES[$fild]) || empty($_FILES[$fild]))
				   {
					   $export['error'] = 'empty';
					   return $export ;
					   
				   }
			
			        $this->config  = $config ; 
					
					$_files = array();
					foreach($_FILES[$fild] as $k=>$v)
					{
						for($i = 0 ; $i < count($_FILES[$fild][$k]) ; $i++ )
						{
							$_files[$i][$k] = $_FILES[$fild][$k][$i] ;
						}
					}
					
					
					foreach($_files as $f )
					{
						$_FILES[$fild] = $f ;
						$res = $this->native_upload($fild);
						
						if($res['stat'] == 'ok')
						$export['uploaded'] += 1 ;
						
						$export['files'][] = $res ;
						
					}
					
					return ($export);
		}


	 private function native_upload( $fild = ''    ){
           
		    $ci     = & get_instance();
			$config = $this->config;
 			
			if(!isset($_FILES[$fild]['name']) || trim($_FILES[$fild]['name']) == '') 
			return array('stat'=>'err' , 'error'=>'empty'  );
			
			
			$org_name = $_FILES[$fild]['name'];

			$ci->load->helper('inflector');
			list( $name , $format) =  explode('.' , underscore($_FILES[$fild]['name']));
			$config['file_name' ]= md5(uniqid()).'.'.$format ;
				
			$ci->load->library('upload');
            $ci->upload->initialize($config);
 			if( $ci->upload->do_upload($fild) )
			{
				
                 $done = $ci->upload->data();
			     return array(   
								 'name'    =>$org_name , 
								 'stat'    => 'ok' ,
								 'size'    =>$done['file_size'] ,
                                 'new_name'=>$done['file_name']  ,
                            );

			}
			else
			{
			 
			   return array( 'name' => $org_name , 
			                 'stat'=>'err' , 
							 'config'=>$config , 
							 'error'=> $ci->upload->display_errors()  );
			}
	}
			
			
			
				   
	   }
	  
?>
