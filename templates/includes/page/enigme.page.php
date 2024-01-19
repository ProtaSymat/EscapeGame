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
            <h1 class="display-4 fw-bolder">Créez vos énigmes</h1>
            <p class="lead fw-normal text-white-50 mb-0">Joignez-vous à nos maîtres de mystères en créant vos propres énigmes. Laissez votre imagination guider les autres dans un dédale de questions captivantes.</p>
        </div>
    </div>
</header>
  <section class="container py-5">
    <div class="row d-flex flex-row">
      <div class="col-md-6 flex-column py-5 px-5 d-flex justify-content-center align-items-center"">
        <h2>Ajouter une énigme</h2>
        <form action="" method="post">
          <label class="my-2" for="question">Question</label>
          <br>
          <input type="text" id="question" name="question" required style="width:500px; height:50px; font-size:20px;">
          <br>
          <label class="my-2" for="answer">Réponse attendue</label>
          <br>
          <input type="text" id="answer" name="answer" required style="width:500px; height:50px; font-size:20px;" equired>
          <br>
          <label class="mt-5 mb-2" for="success">Message de succès</label>
          <br>
          <input type="text" id="success" name="success" style="width:500px; height:50px; font-size:20px;">
          <br>
          <label class="my-2" for="failure">Message de mauvaise réponse</label>
          <br>
          <input type="text" id="failure" name="failure" style="width:500px; height:50px; font-size:20px;">
          <br>
          <input class="btn btn-primary my-3" type="submit" value="Ajouter la question">
        </form>
      </div>
      <div class="col-md-6 p-0 h-100">
        <div class="d-flex align-items-center h-100">
          <img src="http://localhost/EscapeGame/images/vitrine.jpg" alt="" class="w-100 object-fit-cover position-md-absolute top-md-50 start-md-50 translate-middle-md" loading="lazy">
        </div>
      </div>
    </div>
  </section>