<?php

require 'CURLRequest.php';

class GoogleImageSearch {
	
	public $baseUrl = 'https://ajax.googleapis.com/ajax/services/search/images';
	public $q = '';
	public $v = '1.0';
	public $as_filetype = 'jpg';
	public $as_rights = '';
	public $as_sitesearch = '';
	public $rsz = 8;
	public $hl = 'en';
	public $imgc = 'color';
	public $imgcolor = '';
	public $imgsz = 'large';
	public $imgtype = '';
	public $restrict = '';
	public $safe = 'off';
	public $start = 0;
	public $key;
	
	private $imagesUrl;
	private $params;
	private $cq;
	private $rawData;
	private $searchCount = 64;
	private $loops = 8;
	
	public function __construct( $api_key = NULL ) {
		if ( isset( $api_key ) ) {
			$this->key = $api_key;
		}
		$this->imagesUrl = array();
	}
	
	public function sendQuery() {
		try {
			for ( $i = 0; $i < $this->loops; $i++ ) {
				$this->cq                         = new CURLQuery( $this->buildQuery() );
				$this->cq->CURLOPT_REFERER        = $_SERVER['HTTP_REFERER'];
				$this->cq->CURLOPT_RETURNTRANSFER = 1;
				$this->rawData                    = $this->cq->doRequest();
				$json                             = json_decode( $this->rawData );
				foreach ( $json->responseData->results as $o ) {
					$this->imagesUrl[] = $o->url;
				}
				$this->start += $this->rsz;
			}
		}
		catch ( Exception $e ) {
			die( $e->getMessage() );
		}
	}
	
	public function getImagesUrl() {
		return $this->imagesUrl;
	}
	
	public function setSearchCount( $n ) {
		$this->searchCount = intval( $n );
		$this->loops       = intval( $this->searchCount / $this->rsz );
	}
	
	private function buildQuery() {
		$this->params = array(
			'q' => $this->q,
			'v' => $this->v,
			'as_filetype' => $this->as_filetype,
			'as_rights' => $this->as_rights,
			'as_sitesearch' => $this->as_sitesearch,
			'rsz' => $this->rsz,
			'hl' => $this->hl,
			'imgc' => $this->imgc,
			'imgcolor' => $this->imgcolor,
			'imgsz' => $this->imgsz,
			'imgtype' => $this->imgtype,
			'restrict' => $this->restrict,
			'safe' => $this->safe,
			'start' => $this->start,
			'userip' => $this->userip,
			'key' => $this->key
		);
		return $this->baseUrl . '?' . http_build_query( $this->params );
	}
	
}
