<header>
    <div class="container">
        <a class="logo" href="/src/index.php">
            <?php
            if ($currPage == 'index') echo "<img class='logo__img' src='./img/netways.png' alt='logo'>";
            else echo "<img class='logo__img' src='../img/netways.png' alt='logo'>";
            ?>
            <span class="logo__text">Movie Lib</span>
        </a>
        
        <form class="header__search" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <?php
            if ($currPage == 'index') echo "<input class='header__search__input' type='text' name='search'>";
            else echo "<input class='header__search__input' type='text' name='library'>";
            ?>
            <input class="header__search__input" type="text" name="search">
            <button class="header__search__button">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 50 50" fill="#fff">
                    <path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"></path>
                </svg>
            </button>
        </form>

        <nav class="header__nav">
            <ul class="header__nav__list">
                <li class="header__nav__elem">
                    <?php
                    if ($currPage == 'index') echo "<a class='header__nav__link header__nav__link-curr' href='/src/index.php'>Home</a>";
                    else echo "<a class='header__nav__link' href='/src/index.php'>Home</a>";
                    ?>
                </li>
                <li class="header__nav__elem">
                    <?php
                    if ($currPage == 'index') echo "<a class='header__nav__link' href='/src/layout/library.php' >Library</a>";
                    else echo "<a class='header__nav__link header__nav__link-curr' href='/src/layout/library.php'>Library</a>";
                    ?>
                </li>
            </ul>
        </nav>
    </div>
</header>
