import React from 'react';

const Word = ({ word, guesses }) => {
    return (
        <div>
            {word.split("").map((letter, index) => (
                <span key={index}>
                    {guesses.includes(letter) ? letter : "_"}
                </span>
            ))}
        </div>
    );
};

export default Word;
