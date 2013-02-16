<?

include_once('libs/resource.php');
include_once('libs/resourcesession.php');
include_once('libs/resourcemanager.php');

// We create a ResourceSession, which is the object responsible
// for tracking which resources the client have, and in which version.
$session = new ResourceSession();
// We init the session, which means that we find the user in the DB
// and get the list of the corresponding resources and versions the
// user have.
$session->init();

// We need a list of servable resources. These are split into "wrapper"
// types, which is the object it will be wrapped in. It would make sens
// to do things diffrently for HTML parts, since you just want the root
// element, and then attach the parameters to that. (but in the interest
// of time...)
$scripts = new ResourceManager('script', 'resources/js', $session);
$styles = new ResourceManager('style', 'resources/css', $session);
$html = new ResourceManager('div', 'resources/html', $session);

// The next part is not that interesting. It is basicly a simple
// framework for loading pages. Only thing worth noticing is that
// we include "pages/master.php".
$page = 'home';
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
// This.. this right here, was the thing i mentioned earlier, being
// something woth noticing.
include('pages/master.php');

?>