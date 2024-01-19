<?php
use Mathys\Controller\QuestionController;
use Mathys\Controller\Database;

$database = new Database();
$questionController = new QuestionController($database);
$questions = $questionController->getQuestions();

foreach ($questions as $key => $question) {
    $percentage = $questionController->calculateSuccessPercentage($question['id']); 
    $questions[$key]['success_rate'] = $percentage;
}

if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'success_rate':
            usort($questions, function($a, $b) {
                return $b['success_rate'] <=> $a['success_rate'];
            });
            break;
        case 'id':
            usort($questions, function($a, $b) {
                return $b['id'] <=> $a['id'];
            });
            break;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $questionController->deleteQuestion($_POST['id']);
    $questions = $questionController->getQuestions();
}
?>
<body>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Arriverez vous à tout répondre ?</h1>
        <p class="lead fw-normal text-white-50 mb-0">Rejoignez l'équipe remplit de mystères</p>
      </div>
    </div>
    </div>
  </header>
  <section class="container py-5">
    <div>
    <h1 class="text-center">Liste des questions</h1>
</div>
<form method="get">
    <input type="hidden" name="page" value="list">
    <input type="hidden" name="layout" value="html">
    <button class="btn btn-primary" type="submit" name="sort" value="success_rate">Trier par taux de réussite</button>
    <button class="btn btn-secondary" type="submit" name="sort" value="id">Trier par dernière question postée</button>
</form>
<table class="table table-bordered w-100 my-3">
        <thead>
            <tr>
                <th>Question</th>
                <th>Taux de réussite</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($questions as $question): ?>
                <tr>
                    <td><?php echo $question['question']; ?></td>
                    <td>
                        <?php 
                        $percentage = $questionController->calculateSuccessPercentage($question['id']); 
                        echo $percentage . '%';
                        ?>
                    </td>
                    <td class="d-flex flex-row text-end">
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $question['id']; ?>">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
                        </form>
                        <a class="btn btn-warning" href="./?page=answer&layout=html&id=<?php echo $question['id']; ?>"><i class="fa fa-pencil"></i> Répondre</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="./?page=enigme&layout=html" class="btn btn-success" role="button" aria-pressed="true">Créer son énigme</a>

</section>
  
