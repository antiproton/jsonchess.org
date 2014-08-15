function normaliseIndentation(node) {
	/*
	remove any indentation caused by the formatting of the source HTML.
	*/
	
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

function trimTextNodes(pre) {
	/*
	<pre>
		<-- text node with whitespace  --|
		<code> ... </code>               |-- remove these to get rid of extra whitespace
		<-- text node with whitespace  --|
	</pre>
	*/
	
	if(pre.childNodes.length === 3 && pre.childNodes[1].tagName === "CODE") {
		pre.removeChild(pre.childNodes[0]);
		pre.removeChild(pre.childNodes[1]);
	}
}

function cleanupCodeTags() {
	var pre = [].slice.call(document.querySelectorAll("pre"));
	var code = [].slice.call(document.querySelectorAll("pre code"));
	
	code.forEach(normaliseIndentation);
	code.forEach(tabsToSpaces);
	pre.forEach(trimTextNodes);
}