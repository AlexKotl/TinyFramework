<?

	function get_tpl($file) {
		global $tpl;
		if (!file_exists(dirname(__FILE__)."/../tpl/{$file}")) return false;
		ob_start();
		include dirname(__FILE__)."/../tpl/{$file}"; 
		return ob_get_clean();
	}
	
	function add_log($type, $description='') {
		if ($description=='') $description = $type;
		CMysql::insert('log', array(
			'type' => $type,
			'description' => $description,
			'ip' => $_SERVER[REMOTE_ADDR],			
			'timestamp' => time(),
			'time' => 'now()',
		));
	}
	
	function log_error($message) {
		global $config;
		if ($message=='') $message = mysql_error();
		mail($config['default_email'],'CMS Error ('.$config['site_name'].')', $message."\n".__FILE__."\n".__LINE__."\n\n".print_r($_REQUEST,true)."\n\n".print_r($_SERVER,true));
		die_error($message);
	}

	function create_select($name, $elements, $selected='', $params="") {
		$r = ""; 
		foreach ($elements as $key => $value) {
			$value = trim($value);
		
			if ($key == $selected) $is_selected = ($type=='radio' ? "checked" : "selected='selected'");
			else $is_selected = '';
			
			if (!empty($key) || !empty($value)) {
				$r .= "<option value='{$key}' {$is_selected}> {$value} </option>\n";
			}
		}
		
		if (is_string($params) && strstr($params,"disabled")!=false) $is_disabled = "disabled";				
		if (is_array($params) && $params['class']!='') $add_string .= ' class="'.$params['class'].'"';
		if (is_array($params) && $params['title']!='') $add_string .= ' title="'.$params['title'].'"';
		if (is_array($params) && $params['id']!='') $add_string .= ' id="'.$params['id'].'"';
		else $add_string .= " id='{$name}' ";
		if (is_array($params) && $params['style']!='') $add_string .= ' style="'.$params['style'].'"';
		
		$r = "<select name='{$name}' {$add_string} {$is_disabled}>\n{$r}\n</select>";
		return $r;
	}
	
	
	
?>