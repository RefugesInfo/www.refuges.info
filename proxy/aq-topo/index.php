<?php

function doEnsureOsmBounds( $coords )
{
	if( $coords != null )
	{
		$x = $coords[0];
		if( $x < 0 )
			return null;
			
		$y = $coords[1];
		if( $y < 0 )
			return null;
		
		$z = $coords[2];
		$nbTiles = pow( 2, $z );
		
		if( $x >= $nbTiles )
			return null;
		
		if( $y >= $nbTiles )
			return null;
	}
	
	return $coords;
}

function returnNotFound()
{
	header( "HTTP/1.0 404 Not Found" );
	return false;
}

// In case the proxy is on a different host
//header( 'Access-Control-Allow-Origin: *' );

if( isset( $_GET['z'] ) )
{
	$x=intval($_GET['x']);
	$y=intval($_GET['y']);
	$z=intval($_GET['z']);
	if( doEnsureOsmBounds( array( $x, $y, $z ) ) && ( $z >= 0 ) && ( $z <= 16 ) )
	{
		$opts = stream_context_create( array( 'http' => array( 'method' => "GET", 'timeout' => 30 ) ) );
		
		$data = @file_get_contents( "http://tiles1.psyberia.org:8683/ots/?i=PNO2OFE0&x=$x&y=$y&z=$z", false, $opts );
		if( $data )
		{
			if( ( strlen( $data ) > 5 ) && ( ( ord( $data[0] ) == 137 ) || ( ord( $data[0] ) == 255 ) ) )
			{
				header( 'Content-Type: image/png' );
				header( 'Content-Length: ' . strlen( $data ) );
				echo $data;
			}
			else return returnNotFound();
		}
		else
		{
			$data = @file_get_contents( "http://tiles2.psyberia.org:8683/ots/?i=PNO2OFE0&x=$x&y=$y&z=$z", false, $opts );
			if( $data )
			{
				if( ( strlen( $data ) > 5 ) && ( ( ord( $data[0] ) == 137 ) || ( ord( $data[0] ) == 255 ) ) )
				{
					header( 'Content-Type: image/png' );
					header( 'Content-Length: ' . strlen( $data ) );
					echo $data;
				}
				else return returnNotFound();
			}
			else
			{
				$data = @file_get_contents( "http://tiles3.psyberia.org:8683/ots/?i=PNO2OFE0&x=$x&y=$y&z=$z", false, $opts );
				if( $data )
				{
					if( ( strlen( $data ) > 5 ) && ( ( ord( $data[0] ) == 137 ) || ( ord( $data[0] ) == 255 ) ) )
					{
						header( 'Content-Type: image/png' );
						header( 'Content-Length: ' . strlen( $data ) );
						echo $data;
					}
					else return returnNotFound();
				}
				else return returnNotFound();
			}
		}
	}
	else return returnNotFound();
}
else return returnNotFound();

?>