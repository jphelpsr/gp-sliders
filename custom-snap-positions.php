<?php
/**
 * Gravity Perks Sliders — custom snap positions
 *
 * Form 8, Field 1
 *
 * 50K → 500K: 50K increments
 * 500K → 1M: 100K increments
 * 1M → 10M: 500K increments
 */

add_filter( 'gps_snaps_8_1', function( $snaps, $config, $mode ) {

	$min = 50000;
	$max = 10000000;

	$values = array();

	// Always include min.
	$values[] = $min;

	// 50K increments through 500K.
	for ( $value = 100000; $value <= 500000; $value += 50000 ) {
		$values[] = $value;
	}

	// 100K increments through 1M.
	for ( $value = 600000; $value <= 1000000; $value += 100000 ) {
		$values[] = $value;
	}

	// 500K increments through max.
	for ( $value = 1500000; $value <= $max; $value += 500000 ) {
		$values[] = $value;
	}

	$values = array_values( array_unique( $values ) );
	sort( $values, SORT_NUMERIC );

	$snaps      = array();
	$last_index = count( $values ) - 1;

	foreach ( $values as $index => $value ) {

		if ( $value >= 1000000 ) {

			$label = rtrim(
				rtrim(
					number_format( $value / 1000000, 1 ),
					'0'
				),
				'.'
			) . 'M';

		} else {

			$label = rtrim(
				rtrim(
					number_format( $value / 1000, 1 ),
					'0'
				),
				'.'
			) . 'K';
		}

		$snaps[] = array(
			'value'    => $value,
			// Evenly spaced by position in the list, not by real value
			'percent'  => ( $last_index > 0 ) ? ( $index / $last_index ) * 100 : 0,
			'label'    => $label,
			'showTick' => true,
		);
	}

	return $snaps;

}, 10, 3 );
?>
