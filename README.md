dokuwiki-ticket
===============

Allows to link to a ticket system (eg. redmine)

Usage
-----

Your tickets references have to be numeric. In the editor, type something like:

````
As specified in ticket #1234 ...
````

It will be parsed into a link, and the displayed text will be ````#1234````. Don't forget to configure the base url
of your ticket system in the admin pannel, and insert ````%s```` where the ticket number should be inserted:

````
http://your-ticket-system.net/ticket-%s/view
````

Result:
````html
<a href="http://your-ticket-system.net/ticket-1234/view" title="Ticket #1234">#1234</a>
````


Installation
------------

ZIP file: https://github.com/rohm1/dokuwiki-ticket/archive/master.zip

If you install this plugin manually, make sure it is installed in
lib/plugins/ticket/ - if the folder is called different it
will not work!

Please refer to http://www.dokuwiki.org/plugins for additional info
on how to install plugins in DokuWiki.


License
-------

Copyright (C) Romain Perez <rp@rohm1.com>

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

See the COPYING file in your DokuWiki folder for details
