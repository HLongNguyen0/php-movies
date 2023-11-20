<form action="">
    <ul class="pagination">
        <?php

        if($_SESSION["page"] < 5) {
            for ($i = 0; $i < 7; $i++) {
                echo "
                <li class='pagination__elem'>
                    <button class='pagination__button' type='submit'>" . $i + 1 . "</button>
                </li>
                ";
            }
        }

        ?>

    </ul>
</form>