<?php
namespace Geonamesorg;
//namespace App;
/*
use Database\Database;
use FileSystem\ImportFile;
*/
class App {

    public function __construct() {
        
    }

    public function run() {
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
        $importFile = new importFile();
        $importFile->openFile('alternateNames.txt');
        $db = new Database();
        while ($lines = $importFile->readLines(999, $keys)) {
            $importData = array();
            foreach ($lines as $values) {
                $importData[] = $values;
            }

            $db->insert($importData, $keys, 'alternate_names');
            print_r($importData);
        }

        //print_r($db->read('alternate_names'));  
    }

}
