<h2>Aggressive client-side caching</h2>
<p>
This page is an example of how to store content in localStorage on the client, so that static content doesn't have to be reqest each time.
</p>
<p>
One of the main difficulties is versioning. Since you store content on the client, and never requests for it, you don't know if it has been updated on the server. This system tracks ressources along with a version number to see if anything has changed since last visit. On this example page it uses the files last modified timestamp, which means that you don't have to worry about versioning your files, as soon as you change them, the site knows it is a new version.
</p>
<p>
Well, I am not going to go into to many details, since you got the source, with comments, so just poke around. Need more info? I have a few posts about this technique on my page, <a href="morten.olsen.io">morten.olsen.io</a> or send me a mail <a href="mailto:morten@olsen.io">morten@olsen.io</a>
</p>