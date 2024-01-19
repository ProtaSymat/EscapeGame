<?php

use Mathys\Controller\QuestionController;
use Mathys\Controller\Database;

$database = new Database();
$questionController = new QuestionController($database);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de la question
    $questionData = $questionController->getQuestion($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userAnswer = $_POST['answer'];
        $result = $questionController->checkAnswer($id, $userAnswer);
        
        if ($result) {
            $message = $questionData['success_message'];
            $formVisible = false;
        } else {
            $message = $questionData['failure_message'];
            $formVisible = true;
        }
    } else {
        $formVisible = true;
        $message = '';
    }
} else {
    // Si id n'est pas défini, afficher un message d'erreur
    echo "ID de question non trouvé.";
    exit;
}
?>

<body>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Place à la réflexion</h1>
        <p class="lead fw-normal text-white-50 mb-0">Rejoignez l'équipe remplit de mystères</p>
      </div>
    </div>
    </div>
  </header>
  <section class="container py-5">

<h2><?php echo $questionData['question']; ?></h2>

<p> Pourcentage de réussite de la question : 
<?php 
$percentage = $questionController->calculateSuccessPercentage($id); 
echo $percentage . '%';
?>
</p>

<?php if ($formVisible) : ?>
<form action="" method="post">
    <input type="text" id="answer" name="answer" required><br>
    <input type="submit" value="Valider">
</form> 
<?php endif; ?>

<p><?php echo $message; ?></p>
  </section>