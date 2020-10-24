<?php

class QA_QuestionFunctions {
    private $conn;

    public function __construct() {
        require_once "../functions/datalayer/database.class.php";
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setQuestion($categorieID, $questionName, $questionExemple, $questionStatus, $questionType) {
        $sql = "INSERT INTO question (categorieID, questionName, questionExemple, questionStatus, questionType) VALUES ($categorieID, '$questionName', '$questionExemple', '$questionStatus', '$questionType')";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
    }

    public function updateQuestion($questionID, $categorieID, $questionname, $questionExemple, $questionStatus, $questionType) {
        $sql = "UPDATE question SET categorieID = '$categorieID', questionName = '$questionname', questionExemple = '$questionExemple', questionStatus = '$questionStatus', questionType = '$questionType' WHERE questionID = '$questionID'";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
    }

    public function getCategories() {
        $sql = "SELECT * FROM categorie";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $cat){
                echo "<option value=".$cat->categorieID.">".$cat->categorieName."</option>";
            }
        }
    }

    public function getCategoryName($categoryID) {
        $sql = "SELECT * FROM categorie WHERE categorieID = ?";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $categoryID);
        if($stm->execute()){
            while($row = $stm->fetch(PDO::FETCH_ASSOC)){
                return $row;
            }
        }
        else{
            echo "OEPS";
        }
    }

    public function getQuestionID() {
        $sql = "SELECT * FROM question";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $question){
                echo "<option value=".$question->questionID.">".$question->questionName."</option>";
            }
        }
    }

    public function getQuestionData($questionID) {
        $sql = "SELECT q.questionID, q.questionName, q.questionExemple, q.questionStatus, q.questionType, c.categorieName, q.categorieID FROM question q JOIN categorie c ON c.categorieID = q.categorieID WHERE q.questionID = '$questionID'";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()){
            while($row = $stm->fetch(PDO::FETCH_ASSOC)){
               return $row;
            }
        }
    }

    public function getAllAxis() {
        $sql = "SELECT * FROM axis";
        $stm = $this->conn->prepare($sql);
        if($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $axis) {
                echo "<option value=".$axis->AxisId.">".$axis->AxisName."</option>";
            }
        }

    }

    public function getQuestionAnswer($questionID) {
        $sql = "SELECT * FROM answer WHERE questionID = ?";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $questionID);
        if($stm->execute()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $answer){
                echo "<tr>
                        <td value=".$answer->answerID.">".$answer->answer."</td>
                        <td>Nog niet bestaande score</td>
                        <td>Nog niet bestaande axis</td>
                        <td><i class='fas fa-pencil-alt'></i> <i class='fas fa-trash-alt'></i></td>
                        </tr>";
            }
        }
    }

    public function setQuestionAnswer($answer, $questionID) {
        //Score en Axis moeten nog toegevoegd worden
        $sql = "INSERT INTO answer (answer, questionID) VALUES (?, ?)";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(1, $answer);
        $stm->bindParam(2, $questionID);
        $stm->execute();
    }

    public function getDataFromSelectedQuestionID($questionID) {

    }

    public function fillCategorySelect() {

    }
}