import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'

class RaceMedalEn extends React.Component{

  constructor(){
    super()
    this.state = {
      medal: window.medal,
      titleEn: '',
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
        var displayTitle = <h3>{medal[i]['title_en']}</h3>
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

export default RaceMedalEn
