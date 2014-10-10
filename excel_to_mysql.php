<?php	
	public function upLoadFile(){
		//本地测试系统用
		$upload= $this->getLibrary('upload'); 
		//print_r($upload);die;
		//文件上传类加载 
		//参数：表单名称；上传后新的文件名；存放的文件目录；配置，包含最大文件和文件类型
		$filename = 'upload'.InitPHP::getTime();
		$upload = $upload->upload('muban',$filename, './public/',
	array('maxSize'=>10240,'allowFileType'=>array('csv')));

		$source = SERVER_PATH.'public/'.$filename;
		return $source;
	}

	public function exceltomysql(){
		//先将excel上传
		$res = $this->upLoadFile();
		$handle = fopen ($res,"r");
		
			setlocale(LC_ALL,'zh_CN');
			$listarr = array();
			//打开csv中一行,并用","分割为数组
			while($data = fgetcsv($handle, 1000, ",")){
					$num = count($data);
					for($i=0; $i<$num; $i++){
					$data[$i] = mb_convert_encoding($data[$i],"UTF-8","gbk");
					//echo $data[$i];
			   }
					$listarr[] = $data;
			 }
			//echo '<pre>';
			//print_r($listarr);die;
			$num = count($listarr);			
			for($i=1;$i<$num;$i++)
			{
			 
			  //获取 当前 应该分配的用户id
				if($admin_num>0){
					$createuserid = fmod($i,$admin_num);
					if($createuserid == 0){
						$createuserid = $admin_num;
					}
				}
				$key = $createuserid-1;
				//分配到管理员
				$data['updateuser'] = (int)$admins[$key]['id'];
				
			  //0编号  id
				$data['excel_num'] = $listarr[$i][0];
				$data['id'] = $this->uuid();
			  //1姓名 name
				$data['name'] = $listarr[$i][1];
			  //2性别 gender
				$data['gender'] = trim($listarr[$i][2]) == '男' ? '1' :'0';
			  //3座机号码 telephone
				$data['telephone'] = $listarr[$i][3];
			  //4手机号码 phone
				$data['phone'] = $listarr[$i][4];
			  //5邮箱 email
				$data['email'] = $listarr[$i][5];
			  //6身份证号 identity
				$data['identity'] = $listarr[$i][6];
			  //7职别
				$data['duty'] = $listarr[$i][7];
			  //8职位级别
				$data['level'] = $listarr[$i][8];
			  //9地址
				$data['expressaddress'] = $listarr[$i][9];
			  //10企业类别
				$data['comptype'] = $listarr[$i][10];
			  //11单位
				$data['company'] = $listarr[$i][11];
			  //12会员类别
				$data['membertype'] = $listarr[$i][12];
			  //13到达时间
				$data['airpickupstart'] = strtotime($listarr[$i][13]);
		      //14离开时间
				$data['airpickupend'] = strtotime($listarr[$i][14]);
		      //15是否住宿
				$data['isstay'] = trim($listarr[$i][15]) == '是' ? 1:0;
		      //16酒店
				$data['hotel'] = $listarr[$i][16];
		      //17支付金额
				$data['payprice'] = $listarr[$i][17];
		      //18支付时间
				$data['paytime'] = $listarr[$i][18];
		      //19快递时间
				$data['expresstime'] = $listarr[$i][19];
		      //20快递单号
				$data['expressorder'] = $listarr[$i][20];
		      //21备注
				$data['backup'] = $listarr[$i][21];
		      //22论坛1
			  //根据论坛名称 获取论坛id
			$luntanId = array();
			  if(trim($listarr[$i][22]) != ''){
			 	
			  	$luntanId[] = $this->getluntanid(trim($listarr[$i][22]));
			  
			  }
			 
			  if(trim($listarr[$i][23]) != ''){
			  	$luntanId[] = $this->getluntanid(trim($listarr[$i][23]));
			  }

			  if(trim($listarr[$i][24]) != ''){
			  	$luntanId[] = $this->getluntanid(trim($listarr[$i][24]));
			  }

			  if(trim($listarr[$i][25]) != ''){
			  	$luntanId[] = $this->getluntanid(trim($listarr[$i][25]));
			  }

			  if(trim($listarr[$i][26]) != ''){
			  	$luntanId[] = $this->getluntanid(trim($listarr[$i][26]));
			  }

			  if(trim($listarr[$i][27]) != ''){
			  	$luntanId[] = $this->getluntanid(trim($listarr[$i][27]));
			  }

			  $ids = '';
			  foreach ($luntanId as $k => $v) {
			  	$ids .= $v['id'].',';
			  }
				
			$data['jointype'] = $ids;

			//如果支付金额大于0，将isverify 状态值改为1
			$data['isverify'] = $listarr[$i][17] > 0 ? 1 : 0 ;
			
			// 执行插入
			//插之前 判断 excel_num 是否已经存在  如存在  #则不执行插入操作#  执行修改
			//echo 0000;
			$rs = $this->_getCustomerService()->isexcelnumexist($listarr[$i][0]);
			//print_r($rs);die;
			
			if($rs[0]['total'] == 0){//如不存在 则add
				$this->_getCustomerService()->addcustomers($data);
			}else{//如存在 则update
				$update_data = array();
				$update_data['payprice'] =  $listarr[$i][17];
				$update_data['paytime'] =  $listarr[$i][18];
				//如果支付金额大于0，将isverify 状态值改为1
				$update_data['isverify'] = $listarr[$i][17] > 0 ? 1 : 0 ;
				$rs = $this->_getCustomerService()->excelupdatecustomers($listarr[$i][0],$update_data);

			}

			}
	}