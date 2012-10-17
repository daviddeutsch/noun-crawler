<?php



// Load json list of nouns
$set = new nounSet();

// Traverse list of nouns



class nounSet
{
	var $nouns		= array();
	var $authors	= array();

	function nounSet()
	{
		$json = array();

		foreach ( $json as $noun_id ) {
			$noun = new noun( $noun_id );

			
			$this->addNounAuthor( $noun );
		}
	}

	function addNounAuthor( $noun )
	{
		$url = $noun->author->url;

		if ( !isset( $this->authors[$url] ) ) {
			$this->authors[$url] = new author( $noun->author );
		}

		$this->authors[$url]->addWork( $noun );
	}
}

class author
{
	var $url			= '';
	var $name			= '';
	var $location		= '';
	var $attribute_as	= '';
	var $nouns			= array();

	function author( $author )
	{
		$this->url			= $author->url;
		$this->name			= $author->name;
		$this->location		= $author->location;
		$this->attribute_as	= $author->attribute_as;
	}

	function addWork( $noun )
	{
		if ( isset( $this->nouns[$noun->id] ) ) {
			return null;
		}

		$this->nouns = array_merge( $this->nouns, $noun->id );

		sort( $this->nouns );
	}
}

class noun
{
	var $id		= 0;
	var $path	= '';

	function noun( $id )
	{
		$this->id = $id;
		
		$basepath = dirname(__FILE__) . '/nouns';
		
		$this->path		= dirname(__FILE__) . '/nouns';

		// Download SVG file, if it hasn't been downloaded yet
		if ( !file_exists( $this->path . '/svg_'.$this->id.'.svg' ) ) {
			
		}

		// Download Noun page, convert to json for details, if it doesn't exist yet
		// Populate 
	}

	function download()
	{
		$url = 'http://thenounproject.com/download/zipped/svg_' . $this->id . '.zip';

		$curl_calls = array();
		$curl_calls[CURLOPT_URL]			= $url;
		$curl_calls[CURLOPT_BINARYTRANSFER]	= true;
		$curl_calls[CURLOPT_FILE]			= $this->path . '/zipped/svg_'.$this->id.'.zip';

		$ch = curl_init();

		curl_setopt_array( $ch, $curl_calls );

		$response = curl_exec( $ch );
	}
}

?>
