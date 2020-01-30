import React from 'react';
import { Container } from 'react-bootstrap';
import Home from "./Component/Home";
import Game from "./Component/Game";

class App extends React.Component {

  constructor(props) {
    super(props);

    this.startGame = this.startGame.bind(this);
    this.gameOver = this.gameOver.bind(this);

    this.state = {
      begin : false,
      lose: false,
      score: 0
    };
  }

  startGame() {
    this.setState(state => ({
      begin: true
    }));
  }

  gameOver() {
    this.setState(state => ({
      begin: false,
      lose: true
    }));
  }

  render() {
    const isBegan = this.state.begin;

    return (
      <Container className="App">
        {isBegan ? (
          <Game over={this.gameOver} />
        ) : (
          <Home start={this.startGame} lose={this.state.lose} score={this.state.score} />
        )}
      </Container>
    );
  }
}

export default App;
