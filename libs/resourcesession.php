<?

class ResourceSession {
	public $id;
	public $resource = array();

	public function init() {
		$this->id = $_COOKIE['s'];

		if ($this->id == '') {
			$this->id = uniqid();
			setcookie('s',$this->id,time() + (86400 * 365), '/');
		} else {
			$this->load();
			foreach ($_COOKIE as $key => $value) {
				if (strpos($key, 'c_') === 0) {
					$this->resource[$key] = $value;
					setcookie($key,$value,time() - 10, '/');
				}
			}
			$this->save();
		}
	}

	public function cacheName() {
		return 'cache/rs_' . $this->id;
	}

	public function load() {
		if (file_exists($this->cacheName())) {
			$json = file_get_contents($this->cacheName());
			$data = json_decode($json, true);
			$this->resource = $data;
		}
	}

	public function save() {
		$json = json_encode($this->resource);
		file_put_contents($this->cacheName(), $json);
	}

	public function hasResource($name, $manager) {
		if ($this->resource == null) {
			return false;
		}
		$res = $manager->resources[$name];
		return array_key_exists('c_' . $name, $this->resource) 
			&& $this->resource['c_' . $name] == $res->version;
	}
}

?>