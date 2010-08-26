<?php
/**
*    Class IP Details
*    PHP class for looking into details of a IP address
*
*    @author Chetan <xtrmcoder@gmail.com>
*    @version 05 Sep 2009
*    @copyright GPL © 2009, Chetan Mendhe
*    @license http://creativecommons.org/licenses/by-nc-sa/3.0/ Released under a Creative Commons License
*/ 


class ipdetails
{
	var $ip;
	protected $api="http://66.84.41.158/ip/?ip=";
	var $details;
	var $xml;
	var $curl;
	/**
    *    IP Details Construct
    *    @access public
    *    @param String $ip IP Address Of which the details are to be located.
    *    @return void
    */ 
	public function ipdetails($ipaddress)
	{
		$this->ip=$ipaddress;
		$this->curl=curl_init();
		curl_setopt($this->curl, CURLOPT_URL, $this->api.$this->ip);
		curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		return true;
	}
   	/** 
    * Scan for the details of the ip address
    * @access public
    * @return void
    */ 
	public function scan()
	{
		$this->xml = curl_exec($this->curl);
		preg_match_all('/<([a-zA-Z0-9].*)>(.*)<\/([a-zA-Z0-9].*?)>\n/',$this->xml,$detail);
		$this->details=null;
		$this->details=array();
		for($i=0;$i<=count($detail[1])-1;$i++)
		{
			$this->details[trim($detail[1][$i])]=$detail[2][$i];
		}
		return true;
	}
	
	
	/** 
    * To parse the values of the xml
    * @access private
    * @param String $field The field name of the xml 
    * @return void
    */
	private function parsexml($field)
	{
		preg_match('/<'.$field.'>(.*?)<\/'.$field.'>/',$this->xml,$output);
		return $output[1];
	}
	
	
	/** 
    * Export All the Details as an array
    * @access public
    * @return void
    */
	public function get_details_by_array()
	{
		return $this->details;
	}
	
	
	/** 
    * Export All the Details as xml
    * @access public
    * @return void
    */
    public function exportxml()
	{
		return $this->xml;
	}
	
	/** 
    * Return the Country Code of the given ip address
    * @access public
    * @return void
    */
	public function get_countrycode()
	{
		return $this->details[CountryCode];
	}
	
	/** 
    * Return the Code3 of the given ip address
    * @access public
    * @return void
    */
	public function get_code3()
	{
		return $this->details[Code3];
	}
	
	/** 
    * Return the Country of the given ip address
    * @access public
    * @return void
    */
	public function get_country()
	{
		return $this->details[Country];
	}
	
	/** 
    * Return the Region of the given ip address
    * @access public
    * @return void
    */
	public function get_region()
	{
		return $this->details[Region];
	}
	
	/** 
    * Return the City of the given ip address
    * @access public
    * @return void
    */
	public function get_city()
	{
		return $this->details[City];
	}
	
	/** 
    * Return the PostalCode of the given ip address
    * @access public
    * @return void
    */
	public function get_postalcode()
	{
		return $this->details[PostalCode];
	}
	
	/** 
    * Return the Latitude of the given ip address
    * @access public
    * @return void
    */
	public function get_latitude()
	{
		return $this->details[Latitude];
	}
	
	/** 
    * Return the Longitude of the given ip address
    * @access public
    * @return void
    */
	public function get_longitude()
	{
		return $this->details[Longitude];
	}
	
	/** 
    * Return the DMAcode of the given ip address
    * @access public
    * @return void
    */
	public function get_dmacode()
	{
		return $this->details[DMAcode];
	}
		
	/** 
    * Return the Areacode of the given ip address
    * @access public
    * @return void
    */
	public function get_areacode()
	{
		return $this->details[Areacode];
	}
	
	/** 
    * To set new ip address
    * @access public
    * @return void
    */
    public function setip($ipaddress)
    {
    	$this->ip=$ipaddress;
    	return true;
    }
    
    /** 
    * To close the class
    * @access public
    * @return void
    */
    public function close()
    {
    	curl_close($this->curl);
    	return true;
    }
    
    
	
		
	
	
}