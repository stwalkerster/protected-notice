<?php

$wgExtensionCredits['other'][] = array(
        'path' => __FILE__,
        'name' => "ProtectedNotice",
        'descriptionmsg' => "protectednotice-desc",
        'author' => array("Simon Walker"),
        'url' => "https://github.com/stwalkerster/protected-notice/",
);

$directory = dirname( __FILE__ );

// messages

$wgExtensionMessagesFiles['ProtectedNotice'] = "$directory/ProtectedNotice.i18n.php";

// hooks

$wgHooks['GitViewers'][] = "efGithubViewerHook";

function efGithubViewerHook( &$viewers ) {
	$viewers["git@github.com:(.*).git"]="https://github.com/$1/tree/%H";
	return true;
}

$wgHooks['ArticleViewHeader'][] = "efProtectedNoticeHook";

function efProtectedNoticeHook( &$article, &$outputDone, &$pcache ) {
	global $wgOut, $wgRestrictionLevels;

	// get title
	$title = $article->getTitle();

	// get the restriction types
	$restrictionTypes = $title->getRestrictionTypes();

	// cycle through each type
	foreach ( $restrictionTypes as $type ) {
		// get the restrictions for that type
		$r = $title->getRestrictions( $type );

		// cycle through each restriction level
		foreach ( $wgRestrictionLevels as $level ) {
			// if the level is in the list of restrictions
			// for that type, and it's not blank
			if ( in_array( $level, $r ) && $level != '' ) {
				$wgOut->addWikiText("protected:  $type @ $level <br />");
			}
		}
	}

	// behave nicely and let other hooks run
	return true;
}
