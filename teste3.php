<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sequential Circles</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
        
        body{
            font-family: "Poppins", sans-serif;
        }

        h1{
            font-family: "Roboto Condensed", sans-serif;
            
            
            width: 100%;
            font-size: 10vh;
            font-weight: 900;
            color: #fffaf2;
            text-shadow: 7px 7px 7px rgb(60,60,60);
        }

        a{
            color: black;
        }
        
        .circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            cursor: pointer;
            position: relative;
        }
        .circle.locked {
            background-color: gray;
            cursor: not-allowed;
        }
        .circle.unlocked {
            background-color: green;
            cursor: pointer;
        }
        .circle.completed {
            background-color: green;
        }
        .circle-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
        }
        .text-container {
            margin-left: 20px;
        }
        .description {
            margin-bottom: 30px;
        }
        .additional-info {
            display: none;
            margin-left: 70px; /* Indentation to align with the text */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="description text-center">
            <h1>CIPTEA</h1>
            <p>Siga os passos abaixo para completar seu cadastro e gerar sua carteira</p>
        </div>
        <div class="circle-container">
            <div class="circle unlocked" id="circle1">1</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info1">Cadastro de dados pessoais</a>
                <div id="info1" class="additional-info">
                    <p>Caso queira alterar seus dados, clique <a href="#">aqui</a>. Para visualizar os dados que você cadastrou, clique <a href="#">aqui</a>.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle2">2</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info2">Download do requerimento. Clique aqui para detalhes.</a>
                <div id="info2" class="additional-info">
                    <p>O requerimento contem os dados... faça download, assine, tire uma foto e envie ele clicando no botão abaixo.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle3">3</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info3">Step 3: Description for step 3.</a>
                <div id="info3" class="additional-info">
                    <p>Additional information for step 3.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle4">4</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info4">Step 4: Description for step 4.</a>
                <div id="info4" class="additional-info">
                    <p>Additional information for step 4.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle5">5</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info5">Step 5: Description for step 5.</a>
                <div id="info5" class="additional-info">
                    <p>Additional information for step 5.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle6">6</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info6">Step 6: Description for step 6.</a>
                <div id="info6" class="additional-info">
                    <p>Additional information for step 6.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle7">7</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info7">Step 7: Description for step 7.</a>
                <div id="info7" class="additional-info">
                    <p>Additional information for step 7.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var circles = document.querySelectorAll('.circle');
            circles.forEach(function(circle, index) {
                circle.addEventListener('click', function() {
                    if (circle.classList.contains('unlocked')) {
                        circle.classList.remove('unlocked');
                        circle.classList.add('completed');
                        if (index < circles.length - 1) {
                            circles[index + 1].classList.remove('locked');
                            circles[index + 1].classList.add('unlocked');
                        }
                    }
                });
            });

            var links = document.querySelectorAll('.step-link');
            links.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var target = document.querySelector(link.getAttribute('data-target'));
                    if (target.style.display === 'none' || target.style.display === '') {
                        target.style.display = 'block';
                    } else {
                        target.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
