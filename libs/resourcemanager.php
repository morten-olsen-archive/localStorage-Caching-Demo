<?
// The resource manager is the object responsible for scanning
// directories to get resource, and for writing the right code
// (cached or uncached) to the client.
class ResourceManager {
	// A list of resources, which the resource manager can
	// handle
	public $resources = array();
	// A reference to the session object, so we can find out if
	// a client already have a given resource.
	public $session;
	// The name in which objects should be wrapped. (fx div, script,
	// style etc.)
	public $wrapper;

	// The constructor needs both a wrapper-name and a scan path,
	// so it is important to have directories for each element type.
	// (and only to have servable resources in the directories)
	public function __construct($wrapper, $path, $session) {
		// Since I have decided to add comment to each line: maps the variable.
		$this->wrapper = $wrapper;
		// Since I have decided to add comment to each line: maps the variable.
		$this->session = $session;
		// Created a handler for the directory.
		if ($handle = opendir($path)) {
			// Loops through each file in the directory.
			while (false !== ($entry = readdir($handle))) {
				// Creates that file as a resource.
       			$resource = new Resource($path . '/' . $entry);
       			// And adds it to the resource array.
       			$this->resources[$resource->name] = $resource;
    		}
		}
	}

	public function load($name, $store) {
		$item = $this->resources[$name];

		if (!$this->session->hasResource($name, $this)) {

			$output = '<' . $this->wrapper . 
			' data-name="' . $item->name . '" data-version="' . $item->version . 
			'" data-store="' . ($store ? 'true' : 'false') . '" data-type="' . $this->wrapper . '">' .
			$item->getContent() .
			'</' . $this->wrapper . '>';
		} else {
			$output = '<meta data-type="' . $this->wrapper . 
			'" data-rendered="false" data-name="' . $item->name . 
			'" data-version="' . $item->version . '" />';
		}

		print($output);
	}
}

?>