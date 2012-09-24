Nette, Webloader, Texyla example
================================
This is Nette, Webloader, Texyla and Twitter, from Bootstrap minimal working example (skeleton of project). 

Authors
-------
I just compiled Nette framework with libs - all merit have authors of:

**[Nette](http://www.nette.org "Nette framework")** - [Nette Foundation](http://nettefoundation.com/ "Nette foundation") - https://github.com/nette/nette

**Texyla** - Jan Marek - https://github.com/janmarek/Texyla

**Webloader** - Jan Marek - https://github.com/janmarek/WebLoader

**Twitter, from Bootstrap** - [Twitter, inc](http://www.twitter.com) - https://github.com/twitter/bootstrap

The first concept of this skeleton is from Jan Suchánek.

Thanks!

Use
---
Only think to do after download is (pwd is root of project):
```bash
mkdir log           # make directory for cache
mkdir -p temp/cache # make directory for temp
mkdir -p www/temp   # make directory for webtemp
chown -R www-data:www-data log temp www/temp
```

How does this work
------------------
Nette BasePresenter provide components for: Texyla, css, js. Each component call loader (instance of webloader) and them webloader provide minified compilation of css/js/texyla dependecy. Dependency are determinate in loaders.

Nette have very good work witch cache, you don't have to worry about efficiency. Webloader run only if you change source files.