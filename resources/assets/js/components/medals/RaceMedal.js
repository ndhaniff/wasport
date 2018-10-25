import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class RaceMedal extends React.Component{

  constructor(){
    super()
    this.state = {
      medal: window.medal,
    }
  }



  render(){
    
    return(
      <div>
      {this.props.medalID}
      </div>
    )
  }

}

export default RaceMedal
