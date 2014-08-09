**jsonchess** is a protocol for playing chess games over the internet.  Clients connect to
a server to play games against each other by exchanging messages.  The protocol describes
what messages each end needs to send and listen for, and defines some constants to specify
how they should behave.

The protocol consists of a core, which must be supported by all servers and clients, and
several modules.  Server implementations can support different modules or not as they wish.

To see it in action, go to [jsonchess.com](http://jsonchess.com).

jsonchess is open-source.  If you have any feedback or suggestions, post an issue to
[github](http://github.com/jsonchess/jsonchess).