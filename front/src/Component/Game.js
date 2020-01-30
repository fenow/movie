import React from 'react';
import axios from 'axios';
import { Container, Row, Col, Button } from 'react-bootstrap';

class Game extends React.Component {

  constructor(props) {
    super(props);

    this.state = {
      question : null
    };
  }

  componentDidMount() {
    this.getQuestion()
  }

  getQuestion() {
    axios.get('http://localhost:8000/api/movie/game/play')
      .then(res => {
        this.setState({ question: res.data })
        console.log(res);
      })
  }

  render() {
    console.log('ici');
    const isReady = null !== this.state.question;
    const movieTitle = isReady ? this.state.question.movie_title : '';
    const moviePoster = isReady? this.state.question.movie_poster : '';
    const actorName = isReady ? this.state.question.actor_name : '';
    const actorAvatar = isReady ? this.state.question.actor_avatar : '';

    return (
      <div className="App-header">
        {isReady &&
        <Container>
          <Row className="justify-content-md-center">
            <Col xs lg="12">
              <span>Est ce que {actorName} a joué dans {movieTitle} ?</span>
            </Col>
          </Row>
          <Row className="mt-4">
            <Col lg="6">
              <img src={moviePoster} alt={movieTitle}/>
            </Col>
            <Col lg="6">
              <img src={actorAvatar} alt={actorName}/>
            </Col>
          </Row>
          <Row className="justify-content-md-center mt-4">
            <Button variant="success" className="mr-2" size="lg">Oui</Button>
            <Button variant="danger" className="ml-2" size="lg">Non</Button>
          </Row>
        </Container>
      }
      </div>
    )
  }
}

export default Game;
