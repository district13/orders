<?
namespace Config;

function get()
{
	static $config;
	if(!$config)
	{
		$config = parse_ini_file('configs/application.ini');
		fix_ini_multi($config);
	}
	return $config;
}

function fix_ini_multi(&$ini_arr)
{
	foreach ($ini_arr AS $key => &$value) 
	{
		if (is_array($value)) 
		{
			fix_ini_multi($value);
		}
		if (strpos($key, '.') !== false) 
		{
			$key_arr = explode('.', $key);
			$last_key = array_pop($key_arr);
			$cur_elem = &$ini_arr;
			foreach ($key_arr AS $key_step) 
			{
				if (!isset($cur_elem[$key_step])) 
				{
					$cur_elem[$key_step] = array();
				}
				$cur_elem = &$cur_elem[$key_step];
			}
			$cur_elem[$last_key] = $value;
			unset($ini_arr[$key]);
		}
	}
}