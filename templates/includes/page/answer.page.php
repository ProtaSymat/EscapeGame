<?php

use Mathys\Controller\QuestionController;
use Mathys\Controller\Database;

$database = new Database();
$questionController = new QuestionController($database);
$boutonList = '<a href="./?page=list&layout=html" class="btn btn-secondary mt-2"><i class="fas fa-arrow-right"></i>Voir les autres énigmes</a>';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $questionData = $questionController->getQuestion($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userAnswer = htmlspecialchars($_POST['answer']);
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
    echo "ID de question non trouvé.";
    exit;
}
?>

<body>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Éclairez les mystères</h1>
            <p class="lead fw-normal text-white-50 mb-0">Affrontez les énigmes et prouvez votre perspicacité. C'est ici que vous pourrez vérifier vos réponses.</p>
        </div>
    </div>
</header>
<section class="container py-5">

<h2><?php echo $questionData['question']; ?></h2>

<p> Pourcentage de réussite de la question : 
<?php 
$percentage = $questionController->pourcentage($id);
$difficulty = '';

if($percentage <= 10) {
    $difficulty = 'difficile';
    $color = 'red';
} elseif ($percentage <= 50) {
    $difficulty = 'moyen';
    $color = 'orange';
} else {
    $difficulty = 'facile';
    $color = 'green';
}

echo '<span style="color:'.$color.';">•</span>' . $percentage . '%' . '('.$difficulty.')';
?>
</p>

<?php if ($formVisible) : ?>
<form action="" method="post">
    <input class="my-3" type="text" id="answer" name="answer" required style="width:500px; height:50px; font-size:20px;"><br>
    <input class="btn btn-primary" type="submit" value="Valider"><br>
</form> 
<?php endif; ?>

<p><?php echo $message?></p>
<p><?php echo $boutonList?></p>
</section>