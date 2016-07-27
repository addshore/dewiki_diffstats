Both a PHP and Python script for creating a CSV from the dewiki_diffstats logging created by the below patches.

###Relevant Patches

https://github.com/wikimedia/mediawiki-extensions-WikimediaEvents/commit/184e9008c4648422848e162a775211c1a7f3d37c

https://github.com/wikimedia/mediawiki-extensions-WikimediaEvents/commit/570a3d393ee64aa82f3bd37733cba959c88e3ebe

https://github.com/wikimedia/mediawiki-extensions-WikimediaEvents/commit/406dc10a3460d6a23ec38d45b0361cb9352222d4

### Data Details

 - timestamp: Timestamp of the request eg. 20160726234632
 - oldid: Id of the older revision
 - newid: Id of the newer revision
 - oldtimestamp: Timestamp of the older revision eg. 20160726234632
 - newtimestamp: Timestamp of the newer revision eg. 20160726234632
 - pageid: Page id being compared
 - revisions: Number of revisions of the page stored in the revisions table
 - intermediate: Number of revisions between the old and new revision
 - olderrevs: Number of revisions older than the old revision
 - newerrevs: Number of revisions newer than the new revision
 - revslider: Either 'enabled', 'disabled' or ''. Blank string is for when the state is unknown.
