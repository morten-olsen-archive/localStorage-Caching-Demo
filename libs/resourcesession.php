<?

class ResourceSession {
	public $id;
	public $resource = array();

	public function init() {
		$this->id = $_COOKIE['s'];

		if ($this->id == '') {
			$this->id = uniqid();
			setcookie('s',$this->id,time() + (86400 * 7));
		}
		$this->load();
	}

	public function cacheName() {
		return 'cache/rs_' . $this->id;
	}

	public function track() {
		foreach ($_COOKIE as $key => $value) {
			if (strpos($key, 'c_') === 0) {
				$this->resource[$key] = $value;
				setcookie($key,$value,1);
			}
		}
		$this->save();
	}

	public function load() {
		if (file_exists($this->cacheName())) {
			$json = file_get_contents($this->cacheName());
			$data = json_decode($json, true);
			$this->resource = $data;
		}
	}

	public function save() {
		$json = json_encode($this->ressource);
		file_put_contents($this->cacheName(), $json);
	}

	public function hasResource($name, $manager) {
		$res = $manager->resources[$name];
		return array_key_exists('c_' . $name, $this->resource) 
			&& $this->resource['c_' . $name] == $res->version;
	}
}

?>