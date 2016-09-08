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
          <img src="https://nothingaboutscotthere.files.wordpress.com/2015/02/a-mc-random-28.jpg" />
        </CardMedia>
        <CardTitle title="EVENT TITLE" subtitle="EVENT SUBTITLE" />
        <CardText>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Donec mattis pretium massa. Aliquam erat volutpat. Nulla facilisi.
          Donec vulputate interdum sollicitudin. Nunc lacinia auctor quam sed pellentesque.
          Aliquam dui mauris, mattis quis lacus id, pellentesque lobortis odio.
        </CardText>
        <CardActions>
          <FlatButton label="Action1" />
          <FlatButton label="Action2" />
        </CardActions>
      </Card>
    );
  }
}

export default CardThing;