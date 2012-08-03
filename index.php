<html>
</head>
<head>
<body>


<?php

class ImageConverter
{
	public static function convertToHTML($img)
	{
		$width = 172;//(int)$followerImage['Width'];
		$height = 42;//(int)$followerImage['Height'];
		$img = imagecreatefrompng($img);
		$i = 0;
		$j = 0;
		$div = '<div class="image" style="width:172px;height:42px;">';
		$w = 1;
		$prevColor = 0;
		$a = 0;
		for($i=0; $i<42; $i++)
		{
			$div .= '<div style="max-height:1px;min-height:1px;width:172px;overflow:hidden;">';
			for($j=0; $j<172; $j++)
			{
				$color = null;
				$color = imagecolorat($img, $j, $i);
				if($j == 0){
					$prevColor = $color;
				}

				if($color != null && is_int($color))
				{
					if($prevColor != $color || $j == 171)
					{
						$a = ( $prevColor >> 24 ) & 0xFF;
						$r = ( $prevColor >> 16 ) & 0xFF;
						$g = ( $prevColor >> 8 ) & 0xFF;
						$b = $prevColor  & 0xFF;

						$a = ((127 - $a)/127);
						//$a = $a/10;

						$r = (int)($r * $a);
						$g = (int)($g * $a);
						$b = (int)($b * $a);

						$hr = dechex($r);
						$hg = dechex($g);
						$hb = dechex($b);
						if(strlen($hr) == 1){
							$hr = '0'.$hr;
						}
						if(strlen($hg) == 1){
							$hg = '0'.$hg;
						}
						if(strlen($hb) == 1){
							$hb = '0'.$hb;
						}

						$prevColor = $color;

						$wStyle = "";
						$bStyle = "";
						$hex = "";
						
						$wStyle = 'width:'.$w.'px;';
						if($a != 0){
							$hex = 'background-color:#'.$hr.$hg.$hb.';';
							//$bStyle = 'background-color:rgb('.$r.','.$g.','.$b.');';
							$bStyle = $hex;
						}

						$rand = $j;
						if(($rand%2) == 0){
							$div .= '<div style="float:left;max-height:1px;min-height:1px;'.$wStyle.$bStyle.'"></div>';
						} else {
							$div .= '<span style="float:left;min-height:1px;max-height:1px;'.$wStyle.$bStyle.'"></span>';
						}

						$w = 1;
					} 
					else 
					{
						++$w;
					}
				}
			}
			$div .= '</div>';
		}

		echo "\n\n" . $width . " " . $height . "\n\n";

		$div .= '</div>';


	}	
}

?>

</body>
</html>
