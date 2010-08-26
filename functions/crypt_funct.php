<?php
    function crypt_encrypt($val) {
        return base64_encode(strrev($val));
    }

    function crypt_decrypt($val) {
        return strrev(base64_decode($val));
    }

?>