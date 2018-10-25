import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class RaceMedalEn extends React.Component{

  constructor(){
    super()
    this.state = {
      medal: window.medal,
      titleEn: '',
      medalGrey: '',
    }
  }

  render(){

    for(var i=0; i<medal.length; i++) {
      if(medal[i]['mid'] == this.props.medalID) {
        var displayMedal = <img src={medal[i]['grey_medal']} style={{width:'100%'}} />
        var displayTitle = <h3>{medal[i]['title_en']}</h3>
      }
    }


    return(
      <div id="dash-medal-modal">
        {displayMedal}
        {displayTitle}
      </div>
    )
  }

}

export default RaceMedalEn
