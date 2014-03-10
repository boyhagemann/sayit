<?php

class Scanner
{
	/**
	 * The root folder to seach for files
	 * @var string
	 */
	protected $root = '';

	/**
	 * The folders to ignore searching in
	 *
	 * @var array
	 */
	protected $ignore = array();

	/**
	 * Add a folder to be ignored when searching for files.
	 *
	 * @param string $folder
	 */
	public function ignoreFolder($folder)
	{
		$this->ignore[$folder] = $folder;
	}

	/**
	 * Scan the root folder recursively for .md files
	 *
	 * @param $folder
	 * @return array
	 */
	public function scanForMd($folder)
	{
		$this->root = $folder;
		$mask = '*.md';

		return $this->scan($folder, $mask);
	}

	/**
	 * Scan for files recursively with a file mask
	 *
	 * @param $folder
	 * @param $mask
	 * @return array
	 */
	protected function scan($folder, $mask)
	{
		$path = trim(str_replace($this->root, '', $folder), DIRECTORY_SEPARATOR);

		foreach($this->ignore as $ignore) {
			if(strpos($path, $ignore) === 0) {
				return array();
			}
		}

		$files = File::glob(rtrim($folder, '/') . '/' . $mask);

		foreach(File::directories($folder) as $subfolder) {
			$files = array_merge($files, $this->scan($subfolder, $mask));
		}

		return $files;
	}
}