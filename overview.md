Overview
========

Message format
--------------

The basic format of all messages exchanged on the protocol is a JSON object with a `topic` field and
an optional `data` field.  The topics look like filesystem paths:

`/game/123/move`

For example, the whole message sent by the server when the move e2-e4 is played in the game
with id "123" looks like this:

	{  
		"topic": "/game/123/move",
		"data": {  
			"from": 12,
			"to": 28,
			"index": 0,
			"time": 1407781765400
		}
	}

(The `index` field makes sure that moves can be ordered properly on the client in the
unlikely event that they are received out of order.)