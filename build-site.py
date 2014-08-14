import os, re

"""
This builds the website out of the raw HTML files and templates.
"""

currentdir = os.getcwd()
rawdir = os.path.join(currentdir, "html-raw")
builtdir = os.path.join(currentdir, "html-built")
parentTemplate = None

def href(root, webroot, fn):
	path = os.path.join("/", webroot, fn)
	
	if os.path.isdir(os.path.join(root, fn)):
		return path
	else:
		return path + ".html"

for root, dirs, files in os.walk(rawdir):
	filecontents = lambda fn: open(os.path.join(root, fn)).read()
	webroot = root[len(rawdir):]
	template = filecontents("template.html")
	menu = filecontents("menu.html")
	menu = re.sub(r'\[\[([^\]]+)\]\]', lambda match: href(root, webroot, match.group(1)), menu)
	template = template.replace("{{menu}}", menu)
	
	if parentTemplate:
		template = parentTemplate.replace("{{page}}", template)
	
	parentTemplate = template
	
	builtroot = os.path.join(builtdir, webroot[1:])
	
	for fn in files:
		if fn != "menu.html" and fn != "template.html":
			page = template.replace("{{page}}", filecontents(fn))
			
			if not os.path.exists(builtroot):
				os.makedirs(builtroot)
			
			open(os.path.join(builtroot, fn), "w").write(page)