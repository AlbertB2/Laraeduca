import React from 'react';

const Question = ({ question, options, answer, handleAnswerOptionClick }) => {
    return (
        <div className="question-section">
            <div className="question-text">{question}</div>
            <div className="answer-section">
                {options.map((option, index) => (
                    <button
                        key={index}
                        onClick={() => handleAnswerOptionClick(option === answer)}
                    >
                        {option}
                    </button>
                ))}
            </div>
        </div>
    );
};

export default Question;
