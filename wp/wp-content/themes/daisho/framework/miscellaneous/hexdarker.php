<?php
function hexDarker($hex,$factor = 30){
	$new_hex = '';
	$hex = str_replace('#', '', $hex);
	
	$base['R'] = hexdec($hex{0}.$hex{1});
	$base['G'] = hexdec($hex{2}.$hex{3});
	$base['B'] = hexdec($hex{4}.$hex{5});
	
	foreach ($base as $k => $v)
			{
			$amount = $v / 100;
			$amount = round($amount * $factor);
			$new_decimal = $v - $amount;
	
			$new_hex_component = dechex($new_decimal);
			if(strlen($new_hex_component) < 2)
					{ $new_hex_component = "0".$new_hex_component; }
			$new_hex .= $new_hex_component;
		}
			
	return '#'.$new_hex;
} ?>