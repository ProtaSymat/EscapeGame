<?php

use Mathys\Controller\QuestionController;
use Mathys\Controller\Database;

$database = new Database();
$questionController = new QuestionController($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['question']) && isset($_POST['answer']) && isset($_POST['success']) && isset($_POST['failure'])) {
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $success = $_POST['success'];
        $failure = $_POST['failure'];
    
        $id = $questionController->addQuestion($question, $answer, $success, $failure);
    
        if ($id) {
            header('Location: ?page=answer&layout=html&id=' . $id);

            exit;
        } else {
            echo "Erreur lors de l'ajout de la question.";
        }
    } else {
        echo "Tous les champs requis ne sont pas remplis.";
    }
}
?>
<body>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Posez vos questions</h1>
        <p class="lead fw-normal text-white-50 mb-0">Rejoignez l'équipe remplit de mystères</p>
      </div>
    </div>
    </div>
  </header>
  <section class="container py-5">
<h2>Ajouter une question</h2>


<form action="" method="post">
    <label for="question">Question</label><br>
    <input type="text" id="question" name="question" required><br>
    <label for="answer">Réponse attendue</label><br>
    <input type="text" id="answer" name="answer" required><br>
    <label for="success">Message de succès</label><br>
    <input type="text" id="success" name="success"><br> 
    <label for="failure">Message de mauvaise réponse</label><br>
    <input type="text" id="failure" name="failure"><br>
    <input type="submit" value="Ajouter la question">
</form> 
  </section>