import React, { useState } from 'react';

const HistoryQuiz = () => {
  const questions = [
    {
      question: "¿Quién fue el primer presidente de los Estados Unidos?",
      options: ["George Washington", "Thomas Jefferson", "Abraham Lincoln", "John Adams"],
      answer: "George Washington"
    },
    {
      question: "¿En qué año comenzó la Segunda Guerra Mundial?",
      options: ["1939", "1914", "1945", "1936"],
      answer: "1939"
    },
    {
      question: "¿Qué imperio construyó la Gran Muralla China?",
      options: ["Imperio Ming", "Imperio Han", "Imperio Qin", "Imperio Tang"],
      answer: "Imperio Qin"
    },
    {
      question: "¿Quién escribió 'El origen de las especies'?",
      options: ["Charles Darwin", "Isaac Newton", "Galileo Galilei", "Marie Curie"],
      answer: "Charles Darwin"
    },
    {
      question: "¿Qué evento desencadenó la Primera Guerra Mundial?",
      options: ["Asesinato del archiduque Francisco Fernando", "Invasión de Polonia", "Tratado de Versalles", "Revolución Rusa"],
      answer: "Asesinato del archiduque Francisco Fernando"
    }
  ];

  const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
  const [score, setScore] = useState(0);
  const [showScore, setShowScore] = useState(false);

  const handleAnswerOptionClick = (isCorrect) => {
    if (isCorrect) {
      setScore(score + 1);
    }

    const nextQuestion = currentQuestionIndex + 1;
    if (nextQuestion < questions.length) {
      setCurrentQuestionIndex(nextQuestion);
    } else {
      setShowScore(true);
    }
  };

  const handleRestart = () => {
    setCurrentQuestionIndex(0);
    setScore(0);
    setShowScore(false);
  };

  return (
    <div style={{ textAlign: 'center', fontFamily: 'Arial, sans-serif', maxWidth: '600px', margin: '0 auto' }}>
      <h1 style={{ fontSize: '2rem', marginBottom: '20px'}}>History Quiz</h1>
      {showScore ? (
        <div>
          <p style={{ fontSize: '1.2rem', marginBottom: '20px' }}>You scored {score} out of {questions.length}</p>
          <button onClick={handleRestart} style={{ fontSize: '1rem', padding: '10px 20px',  color: 'black' }}>Restart</button>
        </div>
      ) : (
        <div>
          <div style={{ marginBottom: '20px' }}>
            <p style={{ fontSize: '1.2rem' }}>
              {questions[currentQuestionIndex].question}
            </p>
          </div>
          <div>
            {questions[currentQuestionIndex].options.map((option, index) => (
              <button
                key={index}
                onClick={() => handleAnswerOptionClick(option === questions[currentQuestionIndex].answer)}
                style={{
                  display: 'block',
                  width: '100%',
                  padding: '10px',
                  margin: '10px 0',
                  fontSize: '1rem',
                  backgroundColor: '#f0f0f0',
                  border: '1px solid #ccc',
                  borderRadius: '5px',
                  cursor: 'pointer',
                  color: 'black'
                }}
              >
                {option}
              </button>
            ))}
          </div>
        </div>
      )}
    </div>
  );
};

export default HistoryQuiz;
