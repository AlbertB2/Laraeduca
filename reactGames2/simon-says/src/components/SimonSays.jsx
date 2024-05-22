import React, { useState, useEffect } from 'react';

const SimonButton = ({ color, onClick }) => {
  const buttonStyle = {
    width: '100px',
    height: '100px',
    margin: '10px',
    borderRadius: '10px',
    border: '5px solid transparent',
    transition: 'border-color 0.3s',
    backgroundColor: color,
    cursor: 'pointer',
  };

  return (
    <button className={color} style={buttonStyle} onClick={onClick}></button>
  );
};

const SimonSays = () => {
  const colors = ["red", "blue", "green", "yellow"];
  const [sequence, setSequence] = useState([]);
  const [playerSequence, setPlayerSequence] = useState([]);
  const [isPlayerTurn, setIsPlayerTurn] = useState(false);
  const [isGameOver, setIsGameOver] = useState(false);
  const [message, setMessage] = useState("Press Start to Begin");
  const [index, setIndex] = useState(0); 

  useEffect(() => {
    if (sequence.length && !isPlayerTurn) {
      playSequence();
    }
  }, [sequence]);

  const playSequence = () => {
    let idx = 0;
    const interval = setInterval(() => {
      if (idx < sequence.length) {
        highlightButton(sequence[idx]);
        idx++;
      } else {
        clearInterval(interval);
        setIsPlayerTurn(true);
        setMessage("Your turn");
      }
    }, 1000);
  };

  const highlightButton = (color) => {
    const button = document.querySelector(`.${color}`);
    if (button) {
      button.style.borderColor = 'lightblue'; // Cambia el color del borde aquí
      setTimeout(() => {
        button.style.borderColor = 'transparent';
      }, 500);
    }
  };

  const handleButtonClick = (color) => {
    if (isPlayerTurn) {
      setPlayerSequence([...playerSequence, color]);
      highlightButton(color);

      if (sequence[playerSequence.length] === color) {
        if (playerSequence.length + 1 === sequence.length) {
          setPlayerSequence([]);
          setIsPlayerTurn(false);
          setMessage("Good job! Next round");
          setTimeout(() => {
            addColorToSequence();
            setIndex(0); 
          }, 1000);
        }
      } else {
        setIsGameOver(true);
        setMessage("Game Over! Press Restart to Try Again");
      }
    }
  };

  const addColorToSequence = () => {
    const randomColor = colors[Math.floor(Math.random() * colors.length)];
    setSequence([...sequence, randomColor]);
  };

  const startGame = () => {
    setSequence([]);
    setPlayerSequence([]);
    setIsPlayerTurn(false);
    setIsGameOver(false);
    setMessage("Watch the sequence");
    setTimeout(() => {
      addColorToSequence();
    }, 1000);
  };

  return (
    <div style={{textAlign: 'center', backgroundColor: '#fff', padding: '20px', borderRadius: '10px', boxShadow: '0 0 10px rgba(0, 0, 0, 0.1)', maxWidth: '500px', width: '100%', margin: 'auto'}}>
      <h1 style={{fontSize: '2rem', marginBottom: '20px', color: '#333'}}>Simon Says - Chemistry and Math Edition</h1>
      <p style={{fontSize: '1.2rem', marginBottom: '20px'}}>{message}</p>
      <div style={{display: 'flex', flexWrap: 'wrap', justifyContent: 'center', marginTop: '20px'}}>
        {colors.map((color) => (
          <SimonButton
            key={color}
            color={color}
            onClick={() => handleButtonClick(color)}
          />
        ))}
      </div>
      {isGameOver && <button style={{margin: '5px', padding: '10px 15px', fontSize: '1rem', cursor: 'pointer', backgroundColor: '#007bff', color: '#fff', border: 'none', borderRadius: '5px', transition: 'background-color 0.3s'}} onClick={startGame}>Restart</button>}
      {!sequence.length && <button style={{margin: '5px', padding: '10px 15px', fontSize: '1rem', cursor: 'pointer', backgroundColor: '#007bff', color: '#fff', border: 'none', borderRadius: '5px', transition: 'background-color 0.3s'}} onClick={startGame}>Start</button>}
    </div>
  );
};

export default SimonSays;
