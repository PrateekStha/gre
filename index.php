<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRE WORDS PLAY</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto:400,700&amp;subset=latin-ext" rel="stylesheet">

    <link rel="stylesheet" href="flash/flash.css">
    <style>
        *{margin:0;padding:0}html{background-size:cover}body{overflow-y:hidden;height:33.3vh}.backwala{background-image:url(np.jpg);height:100vh;width:100vw;padding:0;margin:0;background-position:center;background-repeat:no-repeat;background-size:cover;filter:blur(3px)}
    </style>
</head>
<body>
    <div class="backwala">
    </div>
    <div style="position:absolute;top:0px;">
        <header class='head'>GRE FLASH CARD</header>
        <main class='main'>
            <div class='flashcard-container'>
                <div class='card front'>
                    <h3 class='text flashcard-question-head flashcard-question-front'>GRE Flash Card </h3>
                </div>
                <div class='card back hidden' >
                    <h3 class='text flashcard-answer-head'> GRE Flash Card </h3>
                    <p class='text flashcard-answer' style="text-align: left !important;margin:20px"> Click on the 'start' button to... well, to start.</p>
                    <p class='text flashcard-synonym' style="text-align: left !important;margin:0px 20px 20px 20px"> </p>
                </div>
            </div>
            <div style="bottom: 50%;">
                <div class="button-container"><button class="button flashcard-back">Back</button></div>
                <div class="button-container"><button class="button flashcard-reset">Play again</button></div>
                <div class="button-container"><button class="button flashcard-next">Start</button></div>
            </div>
        </main>
    </div>
    <script src="flash/flash.js"></script>
</body>
</html>