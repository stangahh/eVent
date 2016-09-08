import React from 'react';
import {Card, CardActions, CardHeader, CardMedia, CardTitle, CardText} from 'material-ui/Card';
import FlatButton from 'material-ui/FlatButton';

class CardThing extends React.Component {
  render() {
    return (
      <Card>
        <CardHeader
          title="URL Avatar"
          subtitle="Subtitle"
          avatar="https://nothingaboutscotthere.files.wordpress.com/2015/02/a-mc-random-28.jpg"
        />
        <CardMedia
          overlay={<CardTitle title="Overlay title" subtitle="Overlay subtitle" />}
        >
          <img src="" />
        </CardMedia>
        <CardTitle title="EVENT TITLE" subtitle="EVENT SUBTITLE" />
        <CardText>
          This is where event information will go yay.
        </CardText>
        <CardActions>
          <FlatButton label="Join Event" />
          <FlatButton label="Learn More" />
        </CardActions>
      </Card>
    );
  }
}

export default CardThing;