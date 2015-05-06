<?php
class Router{

	protected $url;
	protected $docs_folder;
	protected $method;
	protected $args;
	protected $lib;
	protected $doc_folder;

	function __construct(){
  	$http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
		$this->base_link = $_SERVER['HTTP_HOST'] . '/';
		$this->base_url = $http . '://' . $_SERVER['HTTP_HOST'] . '/';
		$this->root = realpath($_SERVER["DOCUMENT_ROOT"]).'/';
		$this->lib = 'lib/';
		$this->doc_folder = 'docs/';
	}

	function __get_url(){
  	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
    $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);
      for($i= 0;$i < sizeof($scriptName);$i++){
          if ($requestURI[$i] == $scriptName[$i]){
          	unset($requestURI[$i]);
          }
      }
    $this->url = array_values($requestURI);
    $this->urlsize = count($this->url);
  }

	function __get_docs_folder() {
		if(!empty($this->url[0])){
			 $this->docs_foldername = $this->url[0];
		}
		else{
			$this->docs_foldername = "docMapper";
		}
	}

	function __get_docs_file(){
		if(!empty($this->url[1]))
			$this->docs_filename = $this->url[1];
		else
			$this->docs_filename = 'index';
	}

	function __load_helpers(){
		require_once($this->root.$this->lib.'helpers.php');
	}

	function init(){
		$this->__get_url();
		$this->__get_docs_folder();
		$this->__get_docs_file();
		$this->__load_helpers();
	}

	function load_template() {
		$this->doc_url = $this->base_url.$this->doc_folder.$this->docs_foldername.'/'.$this->docs_filename.'.md';
		require_once($this->root.$this->lib.'template.php');
	}

}