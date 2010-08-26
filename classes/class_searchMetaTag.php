<?

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
    # * FILE: /classes/class_searchMetaTags.php
    # ----------------------------------------------------------------------------------------------------

    class SearchMetaTag  extends Handle {

        ##################################################
        # PRIVATE
        ##################################################

        var $id;
        var $name;
        var $code;
        
        function SearchMetaTag($var='') {
            
            if ($var) {
                $db = db_getDBObject();
                $sql = "SELECT * FROM Setting_Search_Tag WHERE name = '$var'";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            } else {
                $db = db_getDBObject();
                $sql = "SELECT * FROM Setting_Search_Tag ORDER BY id";
                $row = mysql_fetch_array($db->query($sql));
                $this->makeFromRow($row);
            }    
        
        }
        
        function makeFromRow($row='') {
            
            $this->id                = ($row["id"])                    ? $row["id"]                : ($this->id                    ? $this->id                :  '');
            $this->name              = ($row["name"])                  ? $row["name"]              : ($this->name                  ? $this->name              :  '');
            $this->value             = ($row["value"])                 ? $row["value"]             : ($this->value                 ? $this->value             :  '');

            
        }
        
        function Save($update = true) {
            
            $this->prepareToSave();
            
            $dbObj = db_getDBObject();
            
            if ($update) {
                
                $sql = "UPDATE Setting_Search_Tag SET"
                    . " value      = $this->value"
                    . " WHERE name = $this->name";

                $dbObj->query($sql);
                
            } else {
                
                $sql = "INSERT INTO Setting_Search_Tag"
                    . " (name,"
                    . " value)"
                    . " VALUES"
                    . " ($this->name,"
                    . " $this->value)";
                
                $dbObj->query($sql);
                
            }
            
            $this->prepareToUse();
            
        }
        
        function isSetField() {
            
            $dbObj = db_getDBObJect();
            
            $sql    = "SELECT * FROM Setting_Search_Tag WHERE name='$this->name'";
            $result = $dbObj->query($sql);
            
            if (mysql_fetch_array($result)) {
                return true;
            }
   
        }
        
        function Delete() {

            $dbObj = db_getDBObJect();

            $sql = "DELETE FROM Setting_Search_Tag WHERE id = '$this->id'";
            $dbObj->query($sql);

        }

        ##################################################
        # PUBLIC
        ##################################################
    
    
    } 
?>
