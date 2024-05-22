import React, { useState } from 'react';

const HangmanGame = () => {
  const words = ["fisica", "quimica", "matematicas", "biologia", "energia", "atomos", "moleculas", "electrones", "neutrones", "protones"];
  const [selectedWord, setSelectedWord] = useState(getRandomWord());
  const [guesses, setGuesses] = useState([]);
  const [incorrectGuesses, setIncorrectGuesses] = useState(0);

  function getRandomWord() {
    return words[Math.floor(Math.random() * words.length)];
  }

  function handleGuess(letter) {
    letter = letter.toLowerCase();
    if (!guesses.includes(letter)) {
      setGuesses([...guesses, letter]);
      if (!selectedWord.includes(letter)) {
        setIncorrectGuesses(incorrectGuesses + 1);
      }
    }
  }

  function getGuessedWord() {
    return selectedWord
      .split('')
      .map(letter => (guesses.includes(letter) ? letter : '_'))
      .join(' ');
  }

  function renderHangman() {
    const stages = [
      `
       _______
      |      |
      |      
      |       
      |        
      |       
      -
      `,
      `
       _______
      |      |
      |      0
      |      
      |        
      |       
      -
      `,
      `
       _______
      |      |
      |      0
      |      |
      |        
      |       
      -
      `,
      `
       _______
      |      |
      |      0
      |     /|
      |        
      |       
      -
      `,
      `
       _______
      |      |
      |      0
      |     /|\\
      |        
      |       
      -
      `,
      `
       _______
      |      |
      |      0
      |     /|\\
      |     /  
      |       
      -
      `,
      `
       _______
      |      |
      |      0
      |     /|\\
      |     / \\
      |       
      -
      `,
    ];

    return stages[incorrectGuesses];
  }

  function isGameOver() {
    return incorrectGuesses >= 6 || getGuessedWord() === selectedWord;
  }

  function handleRestart() {
    setSelectedWord(getRandomWord());
    setGuesses([]);
    setIncorrectGuesses(0);
  }

  return (
    <div style={{ textAlign: 'center', fontFamily: 'Arial, sans-serif', maxWidth: '400px', margin: '0 auto' }}>
      <h1 style={{ fontSize: '2rem', marginBottom: '20px' }}>Hangman Game</h1>
      <div style={{ display: 'flex', justifyContent: 'center', marginBottom: '10px' }}>
        <pre style={{ fontFamily: 'monospace', fontSize: '1rem', lineHeight: '1.2rem' }}>
          {renderHangman()}
        </pre>
      </div>
      <div style={{ marginBottom: '10px' }}>
        {!isGameOver() ? (
          <p style={{ fontSize: '1.2rem', marginBottom: '10px' }}>
            {getGuessedWord()}
          </p>
        ) : (
          <p style={{ fontSize: '1.2rem', marginBottom: '10px' }}>
            The word was: {selectedWord}
          </p>
        )}
      </div>
      <div>
        {!isGameOver() && (
          <p style={{ marginBottom: '10px' }}>
            {Array.from(Array(26), (_, i) => String.fromCharCode(97 + i)).map(letter => (
              <button
                key={letter}
                disabled={guesses.includes(letter)}
                onClick={() => handleGuess(letter)}
                style={{ 
                  marginRight: '5px', 
                  fontSize: '1rem', 
                  padding: '5px 10px', 
                  marginBottom: '5px' 
                }}
              >
                {letter}
              </button>
            ))}
          </p>
        )}
        {isGameOver() && (
          <button onClick={handleRestart} style={{ fontSize: '1rem', padding: '5px 10px' }}>
            Restart
          </button>
        )}
      </div>
    </div>
  );
};

export default HangmanGame;
