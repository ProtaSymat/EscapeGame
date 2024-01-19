<?php

namespace Mathys\Controller;

use Mathys\Controller\Database;

class QuestionController {
    protected $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }
	
    public function addQuestion($question, $answer, $success, $failure) {
        $data = [
            "post" => [
                "question" => $question,
                "expected_answer" => $answer,
                "success_message" => $success,
                "failure_message" => $failure
            ]
        ];
        $this->database->table('questions')->post($data)->do();
        return $this->database->lastInsertId();
    }

    function deleteQuestion($id) {
        $stmt = $this->database->getConnexion()->prepare("DELETE FROM questions WHERE id=?");
        $stmt->execute([$id]);
    }

    function getQuestion($id){
        $stmt = $this->database->getConnexion()->prepare("SELECT * FROM questions WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    function getQuestions() {
        $stmt = $this->database->getConnexion()->prepare("SELECT * FROM questions");
        $stmt->execute();
        return $stmt->fetchAll();
  }

    function checkAnswer($id, $userAnswer){
        $stmt = $this->database->getConnexion()->prepare("SELECT * FROM questions WHERE id=?");
        $stmt->execute([$id]);
        $question = $stmt->fetch();

        if ($question['expected_answer'] == $userAnswer) {
            $stmt = $this->database->getConnexion()->prepare("UPDATE questions SET success_count=success_count+1, total_answers=total_answers+1 WHERE id=?");
            $stmt->execute([$id]);
            return true;
        } else {
            $stmt = $this->database->getConnexion()->prepare("UPDATE questions SET total_answers=total_answers+1 WHERE id=?");
            $stmt->execute([$id]);
            return false;
        }
    }

    function pourcentage($id){
        $stmt = $this->database->getConnexion()->prepare("SELECT success_count, total_answers FROM questions WHERE id=?");
        $stmt->execute([$id]);
        $question = $stmt->fetch();

        if ($question['total_answers'] > 0) {
            return ($question['success_count'] / $question['total_answers']) * 100;
        } else {
            return 0;
        }
    }

}