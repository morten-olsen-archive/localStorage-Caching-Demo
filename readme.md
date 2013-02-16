# Client-Side Caching
This is a proff-of-concept based of my site [morten.olsen.io](http://morten.olsen.io), which stores almost everything in the users localStorage, so it doen’s have to be send again. It does this by inlining all resources (scripts and styles), so the entire page can be send as one reqest. It then stores all cacheable items in the page, with a name, version and a type.
The server side keeps track of which client has what resources using a session cookie, and if the client does not have a resource, it is inline. If the client has it, the resource becomes a meta tag, which the client then replaces with the actual content.

I will not write to much about the code, since i have tried to explain everything it does in comments.