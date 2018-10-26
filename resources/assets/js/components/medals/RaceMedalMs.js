import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class RaceMedalMs extends React.Component{

  constructor(){
    super()
    this.state = {
      medal: window.medal,
      titleMs: '',
      medalGrey: '',
    }
  }

  render(){

    for(var i=0; i<medal.length; i++) {
      if(medal[i]['mid'] == this.props.medalID) {
        var displayMedal = <img src={medal[i]['grey_medal']} style={{width:'100%'}} id="dash-medal-img" />
        var displayTitle = <h3>{medal[i]['title_ms']}</h3>
        var viewRace = <a id="btn-view-race-info" href={location.origin + '/racedetails/' + medal[i]['rid']}>View Race Info</a>
      }
    }


    return(
      <div id="dash-medal-modal">
        {displayMedal}
        {displayTitle}
        {viewRace}
      </div>
    )
  }

}

export default RaceMedalMs
