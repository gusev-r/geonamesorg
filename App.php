<?php

namespace Geonamesorg;

use Geonamesorg\Database;
use Geonamesorg\ImportFile;

//namespace App;
/*
  use Database\Database;
  use FileSystem\ImportFile;
 */
class App {

    public function __construct() {
        
    }

    public function importAlternateNames($fileName = 'alternateNames.txt') {
        $keys = array(
            'alternateNameId',
            'geonameid',
            'isolanguage',
            'alternate_name',
            'isPreferredName',
            'isShortName',
            'isColloquial',
            'isHistoric'
        );
        $tableName = 'alternate_names';
        $this->import($tableName, $keys, $fileName);
    }
    public function importGeonames($fileName = 'allCountries.txt') {
        $keys = array(
            'geonameid',
            'name',
            'asciiname',
            'alternatenames',
            'latitude',
            'longitude',
            'feature_class',
            'feature_code',
            'country_code',
            'cc2',
            'admin1_code',
            'admin2_code',
            'admin3_code',
            'admin4_code',
            'population',
            'elevation',
            'gtopo30',
            'timezone',
            'modification_date'
        );
        $tableName = 'geonames';
        $this->import($tableName, $keys, $fileName);
    }

    private function import($tableName, $keys, $fileName) {

        $importFile = new importFile();
        $importFile->openFile($fileName);
        $db = new Database();
        $db->connect();
        
        while ($lines = $importFile->readLines(999, $keys)) {
            $importData = array();
            foreach ($lines as $values) {
                $importData[] = $values;
            }
            $db->insert($importData, $keys, $tableName);
           //  print_r($importData);
        }
        

        //print_r($db->read('alternate_names'));  
    }

}
