import React from 'react';
import axios from 'axios';
import Spinner from "./Common/Spinner";
import { Container, Row, Col, Button } from 'react-bootstrap';

class Game extends React.Component {

  constructor(props) {
    super(props);

    this.answerQuestion = this.answerQuestion.bind(this);

    this.state = {
      question : null
    };
  }

  componentDidMount() {
    this.getQuestion()
  }

  getQuestion() {
    this.setState({
      question: null
    })

    axios.get('http://localhost:8000/api/movie/game/play')
      .then(res => {
        this.setState({ question: res.data })
      })
  }

  answerQuestion(answer) {
    axios.post('http://localhost:8000/api/movie/game/play', {
      answer: answer,
      questionId : this.state.question.id
    }).then(res => {
      if(true === res.data.correct) {
        this.getQuestion()
        this.props.incrScore()
      } else {
        this.props.gameOver()
      }
    })
  }

  render() {
    const question = this.state.question
    const isReady = null !== question
    const movieTitle = isReady ? question.movie_title : ''
    const moviePoster = isReady? question.movie_poster : ''
    const actorName = isReady ? question.actor_name : ''
    const actorAvatar = isReady ? question.actor_avatar : ''

    return (
      <div className="App-header">
        {isReady ? (
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
            <Button variant="success" className="mr-2" size="lg" onClick={() => this.answerQuestion(true)}>Oui</Button>
            <Button variant="danger" className="ml-2" size="lg" onClick={() => this.answerQuestion(false)}>Non</Button>
          </Row>
        </Container>
      ) : (
        <Spinner />
        )
        }
      </div>
    )}
}

export default Game;
