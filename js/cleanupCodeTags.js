function normaliseIndentation(node) {
	var lines = node.innerHTML.split("\n");
	var minIndentationLevel = Infinity;
	
	lines.pop();
	lines.shift();
	
	lines.forEach(function(line) {
		var indentationLevel = (line.match(/^\t*/) || [""])[0].length;
		
		if(indentationLevel < minIndentationLevel) {
			minIndentationLevel = indentationLevel;
		}
	});
	
	if(minIndentationLevel !== Infinity) {
		for(var i = 0; i < lines.length; i++) {
			lines[i] = lines[i].substr(minIndentationLevel);
		}
	}
	
	node.innerHTML = lines.join("\n");
}

function tabsToSpaces(node) {
	node.innerHTML = node.innerHTML.replace(/\t/g, "   ");
}

function cleanupCodeTags() {
	var nodes = [].slice.call(document.querySelectorAll("pre code"));
	
	nodes.forEach(normaliseIndentation);
	nodes.forEach(tabsToSpaces);
}