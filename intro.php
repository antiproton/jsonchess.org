<h1>Introduction</h1>
<h2>Message format</h2>
<p>
	The basic format of all messages exchanged on the protocol is a JSON
	object with a <code>topic</code> field and an optional <code>data</code>
	field. The topics look like URL paths:
</p>
<p>
	<code>/game/123/move</code>
</p>
<p>
	The whole message sent by the server when the move e4 is played in the
	game with id "123" looks like this:
</p>
<pre>
	<code>
		{	
			"topic": "/game/123/move",
			"data": {	
				"from": 12,
					"to": 28,
				"index": 0,
				"time": 1407781765400
			}
		}
	</code>
</pre>
<p>
	(The <code>index</code> field makes sure that moves can be ordered
	properly on the client in case they're received out of order.)
</p>
<h2>
	Data structures
</h2>
<p>
	To avoid repetition, these pages set out some named JSON structures to
	refer to later, using a small set of operators to describe what types and
	ranges of data they can contain.
</p>
<p>
	As well as the names of data structures defined within jsonchess, the following
	keywords are used to refer to primitive JSON types:
</p>
<ul>
	<li><code>Number</code> - a JSON number</li>
	<li><code>String</code> - a JSON string</li>
</ul>
<p>
	The keyword <code>undefined</code> is used to indicate that an object property
	may not be present at all.  For example, in the ClientMove structure the
	promotion field isn't always required:
</p>
<pre>
	<code>
		{
			"from": Square,
			"to": Square,
			"promoteTo": undefined | PieceType
		}
	</code>
</pre>
<h3>Operators</h3>
<ul>
	<li>
		<code>..</code>
		<p>
			Denotes ranges of numbers or letters.  Ranges are always inclusive.
			For example, the following data structure definition accepts a number from 0 to 63
			inclusive:
		</p>
		<p>
			<code>0 .. 63</code>
		</p>
	</li>
	<li>
		<code>|</code>
		<p>
			"or".
		</p>
		<p>
			The following data structure definition accepts either "w" or "b":
		</p>
		<p>
			<code>"w" | "b"</code>
		</p>
	</li>
</ul>
<h3>Arrays</h3>
<p>
	Arrays are written as a type followed by <code>, ...</code> within square brackets.  The
	following data structure definition accepts an array containing zero or more Strings:
</p>
<p>
	<code>[ String, ... ]</code>
</p>
<h3>Summary</h3>
<p>
	When describing protocol messages: data structure references, ranges,
	array notation and "undefined" have special meaning as explained above.
	Everything else is plain JSON.
</p>