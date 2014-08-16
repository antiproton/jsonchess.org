import os, re

"""
This builds the website out of the source HTML files and templates.
"""

currentdir = os.getcwd()
rootsourcedir = os.path.join(currentdir, "html-source")
builtdir = os.path.join(currentdir, "html-built")
parentTemplate = None

def href(root, webroot, fn):
	path = os.path.join("/", webroot, fn)
	
	if os.path.isdir(os.path.join(root, fn)):
		return path
	else:
		return path + ".html"

def build(sourcedir, parentTemplate = None):
	filecontents = lambda fn: open(os.path.join(sourcedir, fn)).read()
	webroot = sourcedir[len(rootsourcedir):]
	template = filecontents("template.html")
	menu = filecontents("menu.html")
	menu = re.sub(r'\[\[([^\]]+)\]\]', lambda match: href(sourcedir, webroot, match.group(1)), menu)
	template = template.replace("{{menu}}", menu)
	
	if parentTemplate:
		template = parentTemplate.replace("{{page}}", template)
	
	builtroot = os.path.join(builtdir, webroot[1:])
	
	for root, dirs, files in os.walk(sourcedir):
		for fn in files:
			if fn != "menu.html" and fn != "template.html":
				page = template.replace("{{page}}", filecontents(fn))
				
				if not os.path.exists(builtroot):
					os.makedirs(builtroot)
				
				open(os.path.join(builtroot, fn), "w").write(page)
		break
	
	for root, dirs, files in os.walk(sourcedir):
		for dir in dirs:
			build(os.path.join(root, dir), template)
		break

build(rootsourcedir)