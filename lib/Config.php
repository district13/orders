<?
namespace Config;

function get()
{
	static $config;
	if(!$config)
	{
		$config = parse_ini_file('configs/application.ini');
	}
	return $config;
}