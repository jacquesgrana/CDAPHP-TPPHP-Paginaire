<main class="d-flex flex-column justify-content-center align-items-center">

    <h3 class="text-center mt-5 mb-2"><?= $actionText ?></h3>
    <?php 
    $isSubmitBtn = false;
    if($action !== 'view') $isSubmitBtn = true; 

    if($action === 'edit') {
        echo "<form class='d-flex align-items-center flex-column mt-3' action='/index.php?page=Livres&method=update&id=" . $id . "' method='POST'>";
    }
    else if($action === 'create') {
        echo "<form class='d-flex align-items-center flex-column mt-3' action='/index.php?page=Livres&method=create' method='POST'>";
    }
    else if($action === 'view') {
        echo "<form class='d-flex align-items-center flex-column mt-3' action='' method='POST'>";
    }
    
    echo "<div class='input-group mb-3 mt-3'>"; 
    echo "<label class='input-group-text' style='width: 120px;' for='isbn'>Isbn</label>";
    echo "<input class='form-control' style='width: 380px;' placeholder='Saisir un code Isbn à 13 chiffres.' type='text' name='isbn' id='isbn' value ='" . (($id !== null) ? $id : '') . "' " . (($action !== 'create') ? 'disabled="disabled"' : '') .">";
    echo'</div>';
    echo "<div class='input-group mb-3 mt-3'>"; 
    echo "<label class='input-group-text' style='width: 120px;' for='title'>Titre</label>";
    echo "<input class='form-control' placeholder='Saisir un titre.' type='text' name='title' id='title' value ='" . (($action !== "create") ? $book->getTitle() : '') . "' " . (($action === 'view') ? 'disabled="disabled"' : '') .">";
    echo'</div>';
    echo "<div class='input-group mb-3 mt-3'>"; 
    echo "<label class='input-group-text' style='width: 120px;' for='author'>Auteur</label>";
    echo "<input class='form-control' placeholder='Saisir un(e) auteur.' type='text' name='author' id='author' value ='" . (($action !== "create") ? $book->getAuthor() : '') . "' " . (($action === 'view') ? 'disabled="disabled"' : '') .">";
    echo'</div>';
    echo "<div class='input-group mb-3 mt-3'>"; 
    echo "<label class='input-group-text' style='width: 120px;' for='type'>Type</label>";
    echo "<input class='form-control' placeholder='Saisir un type.' type='text' name='type' id='type' value ='" . (($action !== "create") ? $book->getType() : '') . "' " . (($action === 'view') ? 'disabled="disabled"' : '') .">";
    echo'</div>';
    echo "<div class='input-group mb-3 mt-3'>"; 
    echo "<label class='input-group-text' style='width: 120px;' for='image'>Image</label>";
    echo "<input class='form-control' placeholder=\"Saisir un nom d'image.\" type='text' name='image' id='image' value ='" . (($action !== "create") ? $book->getImage() : '') . "' " . (($action === 'view') ? 'disabled="disabled"' : '') .">";
    echo'</div>';
    echo "<div class='input-group mb-3 mt-3'>";
    echo "<label class='input-group-text' style='width: 120px;' for='description'>Description</label>";
    echo "<textarea class='form-control' style='height: 80px;' placeholder='Saisir une description.' name='description' id='description' " . (($action === 'view') ? 'disabled="disabled"' : '') .">" . (($action !== "create") ? $book->getDescription() : '') . "</textarea>";
    echo'</div>';
    echo "<div class='d-flex justify-content-center gap-2 mb-1 mt-3'>";
    echo "<button class='btn btn-primary btn-sm' formaction='/index.php?page=Livres&method=index'>&#10226; Retour</button>";
    if($isSubmitBtn) { 
        echo "<button class='btn btn-success btn-sm' type='submit'>&#10004;Valider</button>";
    }
    echo'</div>';
    echo "</form>";
    ?>
</main>
<script type="text/javascript">
    window.onload = function() {
        var submitButton = document.querySelector("button[type='submit']");
        submitButton.onclick = function() {
            return confirm("Voulez-vous vraiment envoyer le formulaire ?");
        }
    }
</script>