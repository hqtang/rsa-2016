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
}