<div class="container">
    <form class="pagination" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <ul class="pagination__list">
            <?php
            if($_SESSION["page"] < 5 || $lastPage <= 7) {
                for ($i = 1; $i <= 7; $i++) {
                    if ($_SESSION["page"] == $i) {
                        echo "
                        <li class='pagination__elem'>
                            <button class='pagination__button pagination__button-curr' type='submit' name='pagination' value=" . $i .">" . $i . "</button>
                        </li>
                        ";
                    } else {
                        echo "
                        <li class='pagination__elem'>
                        <button class='pagination__button' type='submit' name='pagination' value=" . $i .">" . $i . "</button>
                        </li>
                        ";
                    }
                }
            } else {
                echo "
                <li class='pagination__elem'>
                    <button class='pagination__button' type='submit' name='pagination' value='1'>1</button>
                </li>
                <li class='pagination__elem'>
                    <button class='pagination__button' disabled>...</button>
                </li>
                ";
                for ($i = $_SESSION["page"] - 1; $i <= $_SESSION["page"] + 1; $i++) {
                    if ($_SESSION["page"] == $i) {
                        echo "
                        <li class='pagination__elem'>
                            <button class='pagination__button pagination__button-curr' type='submit' name='pagination' value=" . $i .">" . $i . "</button>
                        </li>
                        "; 
                    } else {
                        echo "
                        <li class='pagination__elem'>
                            <button class='pagination__button' type='submit' name='pagination' value=" . $i .">" . $i . "</button>
                        </li>
                        "; 
                    }
                }
                echo "
                <li class='pagination__elem'>
                    <button class='pagination__button' disabled>...</button>
                </li>
                <li class='pagination__elem'>
                    <button class='pagination__button' type='submit' name='pagination' value='" . $lastPage . "'>" . $lastPage . "</button>
                </li>
                ";
            }
            ?>
        </ul>
    </form>
</div>