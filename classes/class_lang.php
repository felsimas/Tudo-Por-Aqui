<?php

    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # SisDir Class- System of Class Online 2009           #
    #                                                                    #
    #                #
    #                       #
    #                                                                    #
    # ---------------- 2009 - this file is used in php. ----------------- #
    #                                                                    #
    # http://wxw.google.cn / wxw.msn.cn #
    ######################################################################
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /classes/class_lang.php
    # ----------------------------------------------------------------------------------------------------
    
    class Lang extends Handle {
        
        var $id;
        var $name;
        var $lang_enabled;
        var $lang_default;
        var $lang_order;
        
        function Lang($var='') {
            
            if ($var) {
                $db = db_getDBObject();
                $sql = "SELECT * FROM Lang WHERE id = '$var'";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            }
            else {
                $this->makeFromRow($var);
            }
            
        }
        
        function makeFromRow($row='') {
            
            $this->id                = ($row["id"])                    ? $row["id"]                : ($this->id                    ? $this->id                :  '');
            $this->name              = ($row["name"])                  ? $row["name"]              : ($this->name                  ? $this->name              :  '');
            $this->lang_enabled      = ($row["lang_enabled"])          ? $row["lang_enabled"]      : ($this->lang_enabled          ? $this->lang_enabled      :  'n');
            $this->lang_default      = ($row["lang_default"])          ? $row["lang_default"]      : ($this->lang_default          ? $this->lang_default      :  'n');
            $this->lang_order      	 = ($row["lang_order"])            ? $row["lang_order"]        : ($this->lang_order            ? $this->lang_order        :  '0');
            
        }
        
        function Save() {

            $this->prepareToSave();

            $dbObj = db_getDBObject();
            

            $sql  = "UPDATE Lang SET"
                . " name     = $this->name,"
                . " lang_enabled  = $this->lang_enabled,"
                . " lang_default  = $this->lang_default,"
                . " lang_order  = $this->lang_order"
                . " WHERE id = $this->id";
                
            if (!$dbObj->query($sql)) {
				return false;
            }

            $this->prepareToUse();
            
            return $this->writeLanguageFile();

        }
        
        function writeLanguageFile() {
			
			$filePath = EDIRECTORY_ROOT.'/custom/lang/language.inc.php';
			
			if (!$file = fopen($filePath, 'w+')) {
				return false;
			}
			
			$buffer = "<?php".PHP_EOL;
			if ($this->hasDefaultLang()) {
				
				$langs = $this->getAll();
				$ids      = array();
				$names    = array();
				foreach ($langs as $row) {
					if ($row['lang_enabled'] == 'y') {
						$ids[]    = $row['id'];
						$names[]  = $row['name'];	
					}
				}
				
				$lang_default = $this->getDefault();
				
				$buffer .= "\$edir_default_language = \"".$lang_default."\";".PHP_EOL.PHP_EOL;

				$buffer .= "\$edir_languages = \"".implode(',', $ids)."\";".PHP_EOL;
				$buffer .= "\$edir_languagenames = \"".implode(',', $names)."\";".PHP_EOL;
				
			}
			
			$return_flag = fwrite($file, $buffer, strlen($buffer));
			
			fclose($file);
			
			return $return_flag;
			
        }
        
        function getAll() {
			
			$dbObj = db_getDBObJect();
			
			$sql    = "SELECT * FROM Lang ORDER BY lang_default DESC, lang_order";
			$result = $dbObj->query($sql);
			
			$rows = array();
			while ($row = mysql_fetch_array($result)) {
				$rows[] = $row;
			}
			
			return $rows;
			
        }
        
        function getDefault() {
			
			$dbObj = db_getDBObJect();
			
			$sql    = "SELECT * FROM Lang WHERE lang_default='y' LIMIT 1";
			$result = $dbObj->query($sql);
			
			if (!$row = mysql_fetch_array($result)) {
				return false;
			}
			
			return $row['id'];
			
        }
        
        function getCountEnabledLang() {
			
			$dbObj = db_getDBObJect();
			
			$sql    = "SELECT * FROM Lang WHERE lang_enabled = 'y'";
			$result = $dbObj->query($sql);
			
			return intval(mysql_num_rows($result));
			
        }
        
        function hasDefaultLang() {
			
			$dbObj = db_getDBObJect();
			
			$sql    = "SELECT * FROM Lang WHERE lang_default = 'y'";
			$result = $dbObj->query($sql);
			
			return (mysql_num_rows($result) ? true : false);
			
        }
        
        function hasDuplicatedOrder() {
			
			$dbObj = db_getDBObJect();
			
			$sql    = "SELECT COUNT(*) AS qtde FROM Lang GROUP BY lang_order HAVING qtde > 1;";
			$result = $dbObj->query($sql);
			
			return (mysql_num_rows($result) ? true : false);
			
        }
        
        function Delete() {

            $dbObj = db_getDBObJect();

            ### LANG
            $sql = "DELETE FROM Lang WHERE id = '$this->id'";
            $dbObj->query($sql);

        }
        
    }