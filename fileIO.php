<!--
Author - Yağızcan Pançak | 260201020
-->

<?php
    function write_log($value){
        $fp = fopen('log.txt', 'a');//opens file in append mode
        fwrite($fp, "$value\n");
        fclose($fp);
    }
?>