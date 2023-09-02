<main class="d-flex flex-column justify-content-center align-items-center">
    <h3 class="text-center mt-5 mb-2">Liste des livres</h3>
    <div class="table-responsive">
    <?php

        echo '<table class="table table-striped table-sm rounded table-hover mt-3 mb-2">';
        echo '<thead>';
        echo '<tr>';
        echo '<th class="px-2">Titre</td>';
        echo '<th class="px-2">Auteur</th>';
        echo '<th class="px-2">Type</th>';
        echo '<th class="px-2">Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($books as $bk) {
            echo '<tr>';
            echo '<td class="px-2 pt-3">'.$bk->getTitle().'</td>';
            echo '<td class="px-2 pt-3">'.$bk->getAuthor().'</td>';
            echo '<td class="px-2 pt-3">'.$bk->getType().'</td>';
            echo '<td class="px-2 pt-2">';
            echo '<div class="btn-group">';
            echo "<a href='" . $endpoint . "?page=Livre&method=index&action=view&id=" . $bk->getId() . "' class='btn btn-primary btn-sm'>&#128196; Voir</a>";
            echo "<a href='" . $endpoint . "?page=Livre&method=index&action=edit&id=" . $bk->getId() . "' class='btn btn-success btn-sm'>&#9998; Editer</a>";
            echo "<a href='<" . $endpoint . "?page=Livres&method=delete&id=" . $bk->getId() . "' onclick='return confirm(\"Voulez-vous supprimer ce livre ?\")' class='btn btn-danger btn-sm'>X Supprimer</a>";
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div class="d-flex justify-content-between">';
        echo '<a href="./?page=Livres&method=index&action=previous" class="btn btn-primary btn-sm mt-3 mb-1">◀ Page précédente</a>';
        echo "<a href='./?page=Livre&method=index&action=create' class='btn btn-success btn-sm mt-3 mb-1'>&#43; Ajouter</a>";
        echo '<a href="./?page=Livres&method=index&action=next" class="btn btn-primary btn-sm mt-3 mb-1">Page suivante ▶</a>';
        echo '</div>';
        echo '<p class="text-center">Page ' . ($page+1) . ' / ' . ($maxPage+1) . '</p>'

    ?>
    </div>
</main>