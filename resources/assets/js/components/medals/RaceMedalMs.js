import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class RaceMedalMs extends React.Component{

  constructor(){
    super()
    this.state = {
      medal: window.medal,
      titleMs: '',
    }
  }

  render(){
    var displayMedal;
    for(var i=0; i<medal.length; i++) {
      if(medal[i]['mid'] == this.props.medalID) {
        if(medal[i]['medal_status'] == 'true') {
          displayMedal = <img src={medal[i]['medal_color']} style={{width:'100%'}} id="dash-medal-img"/>
        }
        if(medal[i]['medal_status'] == 'false') {
          displayMedal = <img src={medal[i]['medal_grey']} style={{width:'100%'}} id="dash-medal-img"/>
        }
        var displayTitle = <h3>{medal[i]['title_ms']}</h3>
        var viewRace = <a id="btn-view-race-info" href={location.origin + '/racedetails/' + medal[i]['rid']}>Tengok Maklumat Acara</a>
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
