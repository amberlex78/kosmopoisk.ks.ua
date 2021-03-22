<?php defined('SYSPATH') or die('No direct script access.');

class Config_Group extends Kohana_Config_Group
{
	/**
	 * Запись в файл конфига
	 */
	public function save()
	{
		$files = Kohana::find_file('config', $this->_group_name);
		if (count($files) == 1)
			$filename = $files[0];
		else
			$filename = $files[count($files)-1];

		file_put_contents($filename, $this->encode($this->getArrayCopy()));
	}

	protected function encode($array, $pref = "\t")
	{
		if ($pref == "\t")
			$res = "<?php defined('SYSPATH') or die('No direct script access.');\n\nreturn array(\n";
		else
			$res = "array(\n";

		foreach ($array as $i => $v)
			$res .= $pref . (!is_numeric($i) ? "'" . str_replace("'", "\\'", $i) . "' => " : "") .
					(is_array($v)
						? self::encode($v, $pref . "\t")
						: (is_numeric($v)
								? $v
								: (is_bool($v)
									? ($v ? 'true' : 'false')
									: "'" . preg_replace("/(?<!\\\)'/ui", "\\'", str_replace("\\'", "\\\\\\'", $v)) . "'"))) . ",\n";

		return $res . substr($pref, 0, -1) . ($pref == "\t" ? ");" : ")");
	}
}