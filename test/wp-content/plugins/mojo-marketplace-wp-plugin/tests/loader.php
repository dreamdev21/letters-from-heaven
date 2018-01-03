<?php
function mm_jpo_test( $file ) {
	return mm_ab_test_file( 'jetpack-onboarding-v1.7', $file, 'vendor/jetpack/jetpack-onboarding/jetpack-onboarding.php', 'tests/jetpack-onboarding-1.7/jetpack-onboarding.php', 50, DAY_IN_SECONDS * 90 );
}
add_filter( 'mm_require_file', 'mm_jpo_test' );
