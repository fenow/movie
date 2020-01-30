import React from 'react';
import { Button } from 'react-bootstrap';
import Lose from "./Lose";

import logo from '../Assets/images/header.jpg';
import '../Assets/css/App.css';


class Home extends React.Component {

  constructor(props) {
    super(props);
    this.handlePlay = this.handlePlay.bind(this);
  }

  handlePlay() {
    this.props.start();
  }

  render() {
    const isGameOver = this.props.lose
    const score = this.props.score

    return (
            <div className="App-header">
              <img src={logo} alt="logo" />
              <Button onClick={this.handlePlay} className="mb-3 mt-3">
                Jouer une partie
              </Button>

              {isGameOver && <Lose score={score} />}

            </div>
    )
  }
}

export default Home;