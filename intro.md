Introduction
========

Message format
--------------

The basic format of all messages exchanged on the protocol is a JSON object
with a `topic` field and an optional `data` field.  The topics look like
filesystem paths:

`/game/123/move`

The whole message sent by the server when the move e4 is played in the game
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

(The `index` field makes sure that moves can be ordered properly on the
client in the unlikely event that they are received out of order.)

How messages are described in these pages
---------

Each page of this website that deals with a part of the protocol is split
into two sections: 'Data structures' and 'Topics'.  The data structures
section declares some named data structures for referring to later when
describing messages in the topics section.

The scheme for denoting the possible JSON values for part of a structure is
one or more JSON values, data structure references or keywords (see below),
separated by the pipe character.

For example, if part of a message can be either a 'Game' data structure or
null, it would be denoted like this:

	{
		"game": Game | null
	}

Ranges are specified using two periods and are always inclusive: '0 .. 63'
denotes the range of numbers used to represent squares on the board.

####Keywords

- `String`

	JSON string (e.g. chat messages, game ids or player usernames).

- `Number`

	JSON number.

- `undefined`

	Indicates that an object property may not be present at all.
	For example, in the ClientMove structure the promotion field isn't
	always required:

		{
			"from": Square,
			"to": Square,
			"promoteTo": undefined | PieceType
		}