<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sequential Circles</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
                    <p>Additional information for step 1.</p>
                </div>
            </div>
        </div>
        <div class="circle-container">
            <div class="circle locked" id="circle2">2</div>
            <div class="text-container">
                <a href="#" class="step-link" data-target="#info2">Step 2: Description for step 2.</a>
                <div id="info2" class="additional-info">
                    <p>Additional information for step 2.</p>
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
