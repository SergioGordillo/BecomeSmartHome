<?php

class Database{
	public static function connect(){
		// $db = new mysqli('localhost', 'root', '', 'becomesmarthome');
		$db = new mysqli('localhost', 'algorit1_becomesmarthome', 'NBDiCijU0&+z', 'algorit1_becomesmarthome');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}

