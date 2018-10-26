import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class RaceBib extends React.Component{

  constructor(){
    super()
    this.state = {
      name : window.user.name,
      userID: window.user.id,
    }
  }

  componentDidMount() {
        this.updateCanvas();
  }

  updateCanvas() {
        const name = 'Name: ' + this.state.name
        const uid = this.state.userID
        const category = 'Category: ' + this.props.raceCategory

        const context = this.refs.canvas.getContext('2d')
        const thecontext = this.refs.canvas.getContext('2d')
        const thebox = this.refs.canvas.getContext('2d')
        const x = this.refs.canvas.width / 2
        const y = this.refs.canvas.height / 2
        const imageObj = new Image()

        imageObj.onload = function() {
        context.drawImage(imageObj, 0, 0, 800, 520);
        context.rect(0, 200, 850, 150);
        var grd = thebox.createLinearGradient(10, 0, 10, 10);
      	grd.addColorStop(0, '#fff');
      	thebox.fillStyle = grd;
      	thebox.fill();
        context.font = 'italic 100pt Calibri';
        context.textAlign = 'center';
        context.fillStyle = "#000";
      	context.fillText(uid, x, 315);
        context.beginPath();
        context.globalAlpha=0.5;
      	context.rect(0, 460, 800, 60);
      	context.fillStyle = '#fff';
      	context.fill();
        thecontext.fillStyle = '#000';
        thecontext.globalAlpha=1;
        thecontext.font = '25pt Calibri';
        thecontext.fillText(name, 115, 500);
        thecontext.fillText(category, 675, 500);
      };
      imageObj.src = this.props.bibImg;
  }

  downloadCanvas = (event) => {
    this.refs.canvas.toDataURL("image/jpg");
  }

  render(){
    return(
      <div>
        <canvas id="race-bib-canvas" ref="canvas" width={800} height={520}/>
      </div>
    )
  }

}

export default RaceBib
