import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class Certificate extends React.Component{

  constructor(){
    super()
    this.state = {
      displayname: window.name,
      firstname : window.user.firstname,
      lastname : window.user.lastname,
      allmedal : window.allmedal,
      allcertdatas: window.allcertdatas
    }
  }

  componentDidMount() {
    this.updateCanvas();
  }

  updateCanvas() {

    //get user name
    var name = ''

    //if user did not update first name & last name
    //get display name
    if(this.state.firstname == null || this.state.firstname == '')
      name = this.state.displayname
    else
      name = this.state.firstname + ' ' + this.state.lastname

    //get category joined
    const category = 'CATEGORY: ' + this.props.raceCategory

    //get time used to complete race
    var time_used = ''
    var avg_pace = ''

    for(var i=0; i<allcertdatas.length; i++) {
      if(allcertdatas[i]['race_id'] == this.props.raceID) {
        var distance = allcertdatas[i]['s_distance']
        var hour = allcertdatas[i]['s_hour']
        var minute = allcertdatas[i]['s_minute']
        var second = allcertdatas[i]['s_second']

        var time_second = (hour * 3600) + (minute * 60) + Number(second)
        if(hour<10) hour = '0' + hour
        if(minute<10) minute = '0' + minute
        if(second<10) second = '0' + second
        time_used = hour + ':' + minute + ':' + second

        var pace = time_second / distance
        var pace_min = Math.floor(pace / 60)
        if(pace_min < 10)
          var min = '0' + pace_min
        else
          var min = pace_min

        var pace_sec = pace % 60
        if(pace_min < 10)
          var sec = '0' + pace_sec
        else
          var sec = pace_sec

        avg_pace = min + '\"' + Math.floor(sec)
        break;
       }
    }

    const timing = 'TIMING: ' + time_used
    const showPace = 'PACE: ' + avg_pace
    const title = this.props.raceTitle

    const context = this.refs.canvas.getContext('2d')
    const x = this.refs.canvas.width / 2
    const y = this.refs.canvas.height / 2

    const headerObj = new Image();
    const logo = new Image();
    const signature = new Image();

    headerObj.onload = function() {
      context.drawImage(headerObj, 0, 0, 842, 185);
      context.rect(0, 185, 842, 595);
      var grd = context.createLinearGradient(10, 0, 10, 10);
      grd.addColorStop(0, '#fff');
      context.fillStyle = grd;
      context.fill();
      context.beginPath();
      context.rect(0, 540, 842, 55);
      context.fillStyle = '#fff';
    	context.fill();
      context.font = '40pt Calibri';
      context.textAlign = 'center';
      context.fillStyle = "#000";
      context.fillText(name, x, 250);
      context.font = '25pt Calibri';
      context.fillText('SUCESSFULLY COMPLETED', x, 315);
      context.font = 'italic 22pt Calibri';
      context.fillText(title, x, 375);
      context.font = '15pt Calibri';
      context.fillText(category, x, 435);
      context.fillText(timing, x, 465);
      context.fillText(showPace, x, 495);
      context.font = '12pt Calibri';
      context.fillText('wasportsrun.com', 135, 575);
      context.drawImage(signature, 680, 500 , 120, 80);
      context.drawImage(logo, 25, 553 ,45, 30);
    };
    headerObj.src = this.props.certImg;
    logo.src = window.location.origin + '/img/wasport-logo-footer.png';
    signature.src = window.location.origin + '/img/signature.png';
  }

  render(){
    return(
      <div>
        <canvas id="canvas-cert" ref="canvas" width={842} height={595}/>
      </div>
    )
  }

}

export default Certificate
