<main class="d-flex flex-column justify-content-center align-items-center">
    <h3 class="text-center mt-5 mb-2">Liste des livres</h3>
    <div class="table-responsive">
        <?php
        $firstpage = (($page === 0) ? true : false);
        $lastpage = (($page === $maxPage) ? true : false);
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
        foreach ($books as $book) {
            echo '<tr>';
            echo '<td class="px-2 pt-3">' . $book->getTitle() . '</td>';
            echo '<td class="px-2 pt-3">' . $book->getAuthor() . '</td>';
            echo '<td class="px-2 pt-3">' . $book->getType() . '</td>';
            echo '<td class="px-2 pt-2">';
            echo '<div class="btn-group">';
            echo "<a href='" . $endpoint . "?page=Livre&method=index&action=view&id=" . $book->getId() . "' class='btn btn-primary btn-sm'>&#128196; Voir</a>";
            echo "<a href='" . $endpoint . "?page=Livre&method=index&action=edit&id=" . $book->getId() . "' class='btn btn-success btn-sm'>&#9998; Editer</a>";
            echo "<a href='<" . $endpoint . "?page=Livres&method=delete&id=" . $book->getId() . "' onclick='return confirm(\"Voulez-vous supprimer ce livre ?\")' class='btn btn-danger btn-sm'>X Supprimer</a>";
            echo '</div>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<div class="d-flex justify-content-between">';
        echo '<button type="button" class="btn btn-primary btn-sm mt-3 mb-1" onclick="window.location.href=\'./?page=Livres&method=index&action=previous\'"'. ($firstpage ? "disabled=\'disabled\'" : "") .'>◀ Page - </button>';
        echo '<button type="button" class="btn btn-success btn-sm mt-3 mb-1" onclick="window.location.href=\'./?page=Livre&method=index&action=create\'">&#43; Ajouter</button>';
        echo '<button type="button" class="btn btn-primary btn-sm mt-3 mb-1" onclick="window.location.href=\'./?page=Livres&method=index&action=next\'"'. ($lastpage ? "disabled=\'disabled\'" : "") .'>Page + ▶</button>';


        /*
        echo '<a href="./?page=Livres&method=index&action=previous" class="btn btn-primary btn-sm mt-3 mb-1">◀ Page - </a>';
        echo "<a href='./?page=Livre&method=index&action=create' class='btn btn-success btn-sm mt-3 mb-1'>&#43; Ajouter</a>";
        echo '<a href="./?page=Livres&method=index&action=next" class="btn btn-primary btn-sm mt-3 mb-1" >Page + ▶</a>';
        */
        echo '</div>';
        echo '<p class="text-center">Page ' . ($page + 1) . ' / ' . ($maxPage + 1) . '</p>'

        ?>
    </div>
</main>