<?



	# ----------------------------------------------------------------------------------------------------
	# * FILE: /classes/class_locationManager.php
	# ----------------------------------------------------------------------------------------------------

	class LocationManager extends Handle {

		/* table object with location id fields */
		var $table;

		/* arrays to store location objects for results pages */
		var $locations;
		var $instances;

		function LocationManager() {
			$this->relationships = array();
			$this->relationships["estado_id"] = "LocationCountry";
			$this->relationships["cidade_id"]   = "LocationState";
			$this->relationships["bairro_id"]  = "LocationRegion";
			$this->relationships["city_id"]    = "LocationCity";
			$this->relationships["area_id"]    = "LocationArea";
			$this->locations = array();
			$this->instances = 0;
		}

		function getLocationObject($objectName, $objectId){
			if(!$this->locations[$objectName][$objectId]){
				$this->locations[$objectName][$objectId] = new $objectName($objectId);
				$this->instances++;
			}
			return $this->locations[$objectName][$objectId];
		}

		function getInstances(){
			return $this->instances; /* only for statistics */
		}

	}

?>