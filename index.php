<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php5</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>



    <header class="header">

        <div class="header__logo__block">
            <img class="header__logo" src="Mospolytech_logo.jpg" alt="Логотип МПУ">
        </div>

        <div class="header__info__block">
            <p class="header__info__p">Черникова Софья Кирилловна, 201-321</p>
            <p class="header__info__p">Лабораторная работа №5</p>
            <a href="https://drive.google.com/drive/folders/1gBi_TtUPGPIPvIDqv--tZ2Zq3TUt_uzT?usp=sharing">Ссылка на гугл диск с файлами php и css</a>
        </div>

    </header>

    <nav class="nav">

        <?php

        echo '<a href="?html_type=TABLE';

        if (isset($_GET['content']))
            echo '&content=' . $_GET['content'];

        echo '" class="nav__a';

        if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'TABLE')
            echo ' selected"';
        else
            echo '"';
        echo '>Табличная форма</a>';

        echo '<a href="?html_type=DIV';

        if (isset($_GET['content']))
            echo '&content=' . $_GET['content'];

        echo '" class="nav__a';

        if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV')
            echo ' selected"';
        else
            echo '"';
        echo '>Блочная форма</a>';
        ?>

    </nav>



    <main class="main">

        <div class="menu">

            <?php

            for ($i = 1; $i <= 9; $i++) {
                echo '<a href="?content=' . $i;

                if (isset($_GET['html_type']))
                    echo '&html_type=' . $_GET['html_type'];

                echo '" class="menu__item';

                if (isset($_GET['content']) && $_GET['content'] == $i)
                    echo   ' selected"';
                else
                    echo '"';

                if ($i == 1)
                    echo '>Вся таблица умножения</a>';
                else
                    echo '>Таблица умножения на ' . $i . '</a>';
            }

            ?>

        </div>

        <div class="table__block">

            <?php

            function outTableForm()
            {
                echo '<table class="table">';

                if (!isset($_GET['content']) or $_GET['content'] == 1) {
                    for ($i = 2; $i <= 9; $i++) {
                        outRow($i);
                    }
                } else
                    outColumn($_GET['content']);

                echo '</table>';
            }

            function outRow($n)
            {
                echo '<tr class="tr">';
                for ($i = 2; $i <= 9; $i++) {
                    echo '<td class="td">';
                    outNamAsLink($i);
                    echo 'x';
                    outNamAsLink($n);
                    echo '=';
                    if (($i * $n) <= 9)
                        outNamAsLink($i * $n);
                    else
                        echo ($i * $n) . '</td>';
                }
                echo '</tr>';
            }

            function outColumn($n)
            {
                for ($i = 2; $i <= 9; $i++) {
                    echo '<tr class="tr alone">';
                    echo '<td class="td">';
                    outNamAsLink($n);
                    echo 'x';
                    outNamAsLink($i);
                    echo '=';
                    if (($i * $n) <= 9)
                        outNamAsLink($i * $n);
                    else
                        echo ($i * $n) . '</td>';
                    echo '</tr>';
                }
            }

            function outDivForm()
            {
                $R = 0;
                echo '<div class="flex">';
                if (!isset($_GET['content']) or $_GET['content'] == 1) {
                    for ($i = 2; $i <= 9; $i++) {
                        outDivColumn($i, $R);
                    }
                } else {
                    $R = 1;
                    outDivColumn($_GET['content'], $R);
                }

                echo '</div>';
            }

            function outDivColumn($n, $r)
            {
                if ($r == 1)
                    echo '<div class="div alone">';
                else
                    echo '<div class="div">';
                for ($i = 2; $i <= 9; $i++) {
                    outNamAsLink($n);
                    echo 'x';
                    outNamAsLink($i);
                    echo '=';
                    if (($i * $n) <= 9) {
                        outNamAsLink($i * $n);
                        echo '<br>';
                    } else
                        echo ($i * $n) . '<br>';
                }
                echo '</div>';
            }

            function outNamAsLink($n)
            {
                echo '<a href="?content=' . $n . '" class="num__link">' . $n . '</a>';
            }

            if (!isset($_GET['html_type']) or $_GET['html_type'] == 'TABLE')
                outTableForm();
            else
                outDivForm();

            ?>

        </div>

    </main>



    <footer class="footer">

        <p class="footer__p">

            <?php

            if (!isset($_GET['html_type']))
                echo 'Верстка не выбрана: ';
            else {
                if ($_GET['html_type'] == 'TABLE')
                    echo 'Табличная верстка: ';
                else
                    echo 'Блочная верстка: ';
            }
            if (!isset($_GET['content']) or $_GET['content'] == 1)
                echo 'вся таблица умножения';
            else
                echo 'таблица умножения на ' . $_GET['content'];

            ?>

        </p>

        <p class="footer__p">

            <?php

            echo date("d.m.Y H:i:s");

            ?>

        </p>

    </footer>



</body>

</html>