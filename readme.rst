####################
Bogus Stock Exchange
####################

This webapp is an "engine" for managing the trading of "stocks",
the excuse for COMP4711 assignments in the Winter 2016 term..

*****************
Programming Style
*****************

Some of the programming design decisions reflected:

-   The architecture adheres more to the "model-view-adapter" convention,
    where the view is unaware of the source of data and the model is unaware of
    how any data might be presented. The controllers are go-betweens.
-   Views are templated - an overall one for page layout, and then
    individual templates for the panels that are assembled to make up a page.
-   View fragments are used to style single "records" on their own,
    improving cohesion.
-   A base controller takes care of assembling finished pages, using the 
    master template.
-   A base model takes care of CRUD functionality.
-   The CodeIgniter framework folder has been moved outside of the webapp,
    in this case to a "system3" folder at the same hierarchy level as the 
    document root.
-   An ".htaccess" file is incorporated, to configure Apache to remove
    index.php from any URLs.

***************
Project Folders
***************

/data          avatar images, XML data
/application    the obvious
/assets         CSS, javascript & media
/public         folder for public XML-related documents

Assumed: CI system folder is in ../system3

*******
License
*******

Please see the `license
agreement <http://codeigniter.com/userguide3/license.html>`_

*********
Resources
*********

-  `Informational website <https://codeigniter.com/>`_
-  `Source code repo <https://github.com/bcit-ci/CodeIgniter/>`_
-  `User Guide <https://codeigniter.com/userguide3/>`_
-  `Community Forums <https://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki/>`_
-  `Community IRC <https://codeigniter.com/irc>`_

****************
Using the engine
****************

The COMP4711 students have been tasked with building stock trader webapps,
which will broker the purchase and sale of stocks for their
users.

This webapp provides backend support for those agent webapps, and should
prove particularly useful for testing :-/

***************
Acknowledgement
***************

This webapp was written by James Parry, Instructor in Computer Systems
Technology at the British Columbia Institute of Technology,
and Project Lead for CodeIgniter.

CodeIgniter is a project of B.C.I.T.