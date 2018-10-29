import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class Certificate extends React.Component{

  constructor(){
    super()
    this.state = {
      firstname : window.user.firstname,
      lastname : window.user.lastname,
      allmedal : window.allmedal
    }
  }

  componentDidMount() {
      this.updateCanvas();
  }

  updateCanvas() {

    const name = this.state.firstname + ' ' + this.state.lastname
    const category = 'CATEGORY: ' + this.props.raceCategory
    const timing = 'TIMING: 01:30:22'
    const pace = 'PACE: 3"2'
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
      context.fillText(pace, x, 495);
      context.font = '12pt Calibri';
      context.fillText('wasportsrun.com', 135, 575);
      context.drawImage(logo, 25, 553 ,45, 30)
      context.drawImage(signature, 680, 500 , 120, 80)
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
