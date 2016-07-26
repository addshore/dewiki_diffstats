<?php

echo "Running!\n";

if ( !array_key_exists( 1, $argv ) ) {
	throw new Exception( 'Not passed a log file.' );
}
$logFileLocation = $argv[1];
if ( !file_exists( $logFileLocation ) || is_readable( $logFileLocation ) ) {
	throw new Exception( 'Can\'t read log file: ' . $logFileLocation );
}

$outputDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'output';
if ( !is_dir( $outputDirectory ) ) {
	mkdir( $outputDirectory );
}
$outputFileLocation = $outputDirectory . DIRECTORY_SEPARATOR . date( "Y-m-d_H:i:s" ) . '.csv';
$outputHandle = fopen( $outputFileLocation , 'w' );
if ( !$outputHandle ) {
	throw new Exception( 'Could not get output handle' );
}

$inputHandle = fopen( $logFileLocation, "r" );

echo "Input from: $logFileLocation\n";
echo "Output to: $outputFileLocation\n";

if ( $inputHandle ) {
	$headers = array(
		'timestamp', 'oldid', 'newid', 'oldtimestamp', 'newtimestamp', 'pageid', 'revisions',
		'intermediate', 'olderrevs', 'newerrevs', 'revslider'
	);
	while ( ( $line = fgets( $inputHandle ) ) !== false ) {
		if ( $headers ) {
			sort( $headers );
			fputcsv( $outputHandle, $headers );
			$headers = false;
		}
		$lineParts = explode( ' dewiki_diffstats DEBUG: dewiki diff page view ', $line );
		$data = json_decode( trim( $lineParts[1] ), true );
		ksort( $data );
		fputcsv( $outputHandle, $data );
	}

	fclose( $inputHandle );
} else {
	throw new Exception( 'Could not get input handle.' );
}

fclose( $outputHandle );

echo "Done!\n";
