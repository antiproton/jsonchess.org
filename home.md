**jsonchess** is a protocol for playing chess games over the internet.  Clients connect to
a server to play games against each other by exchanging messages.  These documents describe
what messages each end needs to send and listen for, and define some constants to specify
how they should behave.

The protocol consists of a core, which must be supported by all jsonchess servers, and
several optional modules.  Clients can request details of what modules are supported
from the server.

To see it in action, go to [jsonchess.com](http://jsonchess.com).

jsonchess is open-source.  If you have any feedback or suggestions, feel free to post an issue to
[github](http://github.com/jsonchess/jsonchess).