<?php
namespace RefugesInfo\trace\cron\task;

class trace_cron extends \phpbb\cron\task\base
{
	public function should_run()
	{
		/*global $cache_dir;

		return
			filemtime ($cache_dir.'../geoip/GeoIP.dat') <
			time() - 24*3600;*/
	}

	public function run()
	{
		/*global $cache_dir;

		if (!is_dir ($cache_dir.'../geoip/'))
			mkdir ($cache_dir.'../geoip/');

		foreach (['', 'City', 'ASNum', 'ISP', 'Org'] as $dn)
			file_put_contents (
				$cache_dir.'../geoip/GeoIP'.$dn.'.dat',
				gzdecode (
					file_get_contents ('https://mailfud.org/geoip-legacy/GeoIP'.$dn.'.dat.gz')
				)
			);*/
	}
}
