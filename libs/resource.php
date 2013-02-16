<?
// The resource object is an object created for each file
// that a given resource manager can serve (see 
// resourcemanager.php) If you  wanted to extend this, to
// automaticly do things like compresion, this would be a
// good place to start.
class Resource {
	// The original path to the resource. These are relative
	// to the site root.
	public $path;
	// The name of the resource. This is the resource filename
	// without extension.
	public $name;
	// The version. In this example, these are set to the files
	// last modified date.
	public $version;
	// Resources can in theory have there paths as either 
	// relative to the sites root or absolute, but the
	// resource manager, by default, creates them as relative
	public function __construct($path) {
		// We need an info object for getting the extention
		// (so that we can remove it). You could also use this
		// to do action on content, so fx javascipt and css gets
		// minified automaticly.
		$info = pathinfo($path);
		// Gets the name of the file without the extention.
		$this->name = basename($path,'.'.$info['extension']);
		// Maps path to path... nice and easy.
		$this->path = $path;
		// gets the files last modified date, and sets it as
		// version.
		$this->version = filemtime($path);
	}
	// This is also a great place to extend, since this is
	// where the actual content is fetched, so it could do some
	// fancyness, where it added .min after the filename.
	public function getContent() {
		// Returns the content of a given file, as a string.
		return file_get_contents($this->path);
	}
}

?>