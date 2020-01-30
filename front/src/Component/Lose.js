import React from 'react';

class Lose extends React.Component {
  render() {
    const score = this.props.score

    return (
    <div>
      <div>Vous avez perdu</div>
      <div>Votre score : {score}</div>
    </div>
    )
  }
}

export default Lose;
