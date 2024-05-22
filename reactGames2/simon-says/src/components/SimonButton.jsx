import React from 'react';

const SimonButton = ({ color, onClick }) => {
    return (
        <button
            className={`simon-button ${color}`}
            onClick={onClick}
        ></button>
    );
};

export default SimonButton;
