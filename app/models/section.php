<?php

class Section
{
	private $db = null;
	
	public function __construct($arguments)
	{
		$this->db  = $arguments['db'];
	}

	public function get_sections($option = array())
	{
		$datas = $this->db->select("impage_sections", "*", $option);

		return $datas;
	}	

	public function add_section($type, $name, $desc, $code)
	{
		$new_section = array(
				'name'	=> $name
				,'type'	=>	$type
				,'desc'	=>	$desc
				,'content'	=>	$code
				,'sort_order'	=>	1
				,'created_at'	=>	date('c')
				,'modified_at'	=>	date('c')
				,'enabled'		=>	1
			);
		$last_id = $this->db->insert("impage_sections", $new_section);
		return $last_id;
	}

	public function update_section($update_section)
	{
		
		if(!empty($update_section) && isset($update_section['id']))
		{
			$condition = array('section_id' => $update_section['id']);
			unset($update_section['id']);
			$update_section['modified_at'] = date('c');
			$this->db->update("impage_sections", $update_section, $condition);	
		}
		else
		{
			return false;
		}
		

	}

	public function remove_section($conditions)
	{
		$this->db->delete("impage_sections", $conditions);
	}

	public function check_database()
	{
		$data1 = $this->db->query("SHOW TABLES LIKE 'impage_sectionss'")->fetchAll();
		$data2 = $this->db->query("SHOW TABLES LIKE 'impage_comments'")->fetchAll();	

		if(count($data1) > 0 && count($data2) > 0)
		{
			return true;
		}
		return false;
	}

	public function create_database()
	{
		$data = $this->db->query("SHOW TABLES LIKE 'impage_sectionss'")->fetchAll();

		if(count($data) == 0)
		{
			$this->db->query("
						CREATE TABLE IF NOT EXISTS `impage_sections` (
						  `section_id` int(8) NOT NULL AUTO_INCREMENT,
						  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
						  `type` tinyint(1) NOT NULL COMMENT '0 css, 1 javascript, 11 header, 12 body, 13 footer',
						  `desc` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
						  `content` longtext CHARACTER SET utf8,
						  `sort_order` tinyint(3) NOT NULL DEFAULT '0',
						  `created_at` datetime NOT NULL,
						  `modified_at` datetime NOT NULL,
						  `enabled` tinyint(1) NOT NULL DEFAULT '1',
						  PRIMARY KEY (`section_id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		
				");
		}

		$data = $this->db->query("SHOW TABLES LIKE 'impage_comments'")->fetchAll();
		if(count($data) == 0)
		{
			$this->db->query("
						CREATE TABLE IF NOT EXISTS `impage_comments` (
					  `comment_id` int(8) NOT NULL AUTO_INCREMENT,
					  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
					  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
					  `phone` varchar(50) CHARACTER SET utf8 NOT NULL,
					  `message` mediumtext CHARACTER SET utf8 NOT NULL,
					  `read` tinyint(1) NOT NULL DEFAULT '0',
					  `flag` tinyint(1) NOT NULL DEFAULT '0',
					  `created_at` datetime NOT NULL,
					  `readed_at` datetime NOT NULL,
					  PRIMARY KEY (`comment_id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				");
		}

	}
}