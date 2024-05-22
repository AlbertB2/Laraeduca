<div class="mainContentDashboard">
    @livewire('navbar')
    <div class="fullDashboard">
        <div class="games">
            <div class="game">
                <img class="gamePortada" src="reactGames/gamesCovers/hangmanPortada.jpg" alt="">
                <a class="gameTitle" href="{{ url('/hangman') }}" target="_blank" class="btn btn-primary">Play Hangman Game</a>
            </div>

            <div class="game">
                <img class="gamePortada" id="historyPortada" src="reactGames/gamesCovers/history-quiz.jpg" alt="">
                <a class="gameTitle" href="{{ url('/quiz') }}" target="_blank" class="btn btn-primary">Play Quiz Game</a>
            </div>

            <div class="game">
                <img class="gamePortada" src="reactGames/gamesCovers/simon.png" alt="">
                <a class="gameTitle" href="{{ url('/simon') }}" target="_blank" class="btn btn-primary">Play Simon Says Game</a>
            </div>
        </div>

    </div>
</div>
