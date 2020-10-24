<?php

require '../functions/datalayer/AxisDatabase.php';

class AxisController {
    private $db;
    private $AxisId;

    public function __construct() {
        $this->db = new AxisDatabase();
    }

    public function GetAxis() {
        $Lijst = array();

        $Lijst = $this->db->GetAllAxis();

        // Returning the list given from the Database class
        return $Lijst;
    }

    public function showAxisName($Aid) {
        $this->AxisId = $Aid;
        $AxisName = $this->db->showA($this->AxisId);
        return $AxisName;
    }

    /**
     * @param mixed $AxisId
     */
    public function setAxisId($AxisId) {
        $this->AxisId = $AxisId;
    }

}