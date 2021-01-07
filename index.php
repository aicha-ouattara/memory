<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <title>Accueil</title>
</head>

<body>

    <header>
        <?php include("includes/header.php"); ?>

        <section class="home">
            <img src="img/monsterred.png" class="monster">
            <h1>MONSTER MEMORY</h1>
            <img src="img/yellow.png" class="monster">
        </section>

        <a href="#container_home"><img src="img/arrow.png" class="arrow"></a>

    </header>

    <main>

        <section id="container_home">
            <article class="presentation">
                <div class="dialogue">
                    <h2> <br>Bienvenue sur la planête des monstres gentils ! </h2>
                    <p>J'espere que tu a fais bon voyage jusqu'a notre planète... Nous sommes ici, moi et mes copain monstres, pour t'aider à travailler ta mémoire tout en s'amusant ! <br> Amuse toi bien et reviens nous voir quand tu veux! </p>
                </div>
            </article>

            <article>
                <img src="img/green.png" class="poulpevert">
            </article>

            <a href="#classement"><img src="img/arrow2.png" class="arrow2"></a>
        </section>

        <section id="classement">

            <article class="title_class">
                <div class="monster_class">
                    <img src="img/bluemonster.png" class="bluemonster">
                </div>
                <div class="container_title">
                    <h2>WALK OF FAME</h2>
                    <h3>Le classement des meilleurs petit monstres !</h3>
                </div>
            </article>

            <article class="table_class">

                <img src="classement.jpg" class="imgclass">
            </article>

            <div class="play">
                <a href="#">
                    <h4 class="title_play">A toi de jouer ! </h4>
                </a>
            </div>
        </section>

    </main>

    <footer>
        <?php include("includes/footer.php"); ?>
    </footer>

</body>

</html>