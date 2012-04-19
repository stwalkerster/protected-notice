ProtectedNotice
================

A MediaWiki extension which automatically adds a notice to the top of a page if the page is protected.

##Installation

```
cd /path/to/mediawiki/extensions
git clone git://github.com/stwalkerster/protected-notice.git
cd ..
echo 'require_once("$IP/extensions/protected-notice/ProtectedNotice.php");' >> LocalSettings.php
```