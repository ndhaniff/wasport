import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './BibModalEn';

const submitIC = window.location.origin + '/img/ic-submit.png';
const rankIC = window.location.origin + '/img/ic-rank.png';
const certIC = window.location.origin + '/img/ic-cert.png';

class JoinedRaceEn extends Component{

  constructor(){
    super();
    this.state = {
      race : window.race,
    }
  }

  createRaceItems() {
    let items = [];

    for(var i=0; i<race.length; i++) {
      items.push(
        <div className="col-sm-12 col-md-6">
          <div className="user-history-joined">
            <img src={race[i]['header']} style={{width: '100%'}}/>

            <div className="user-history-joined-content">
              <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{race[i]['title_en']}</h4>
              <p style={{fontFamily: 'SourceSansPro-Light'}}>{race[i]['date']}</p>
              <Progress percent={0} showInfo={false}/>
              <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{race[i]['category']}</span>

              <hr />

              <div className="row" id="joined-race-footer">
                <div className="col-sm-4">
                  <Button>
                    <img src= {rankIC} /><br />
                    <span>Rankings</span></Button>
                </div>
                <div className="col-sm-4">
                  <BibModal raceCategory = {race[i]['category']} />
                </div>
                <div className="col-sm-4">
                  <Button>
                    <img src= {certIC} /><br />
                    <span>Certificate</span></Button>
                </div>
              </div>
            </div>
          </div>
        </div>)}

    return items;
  }

  render(){

    return(
      <div className="row">
        {this.createRaceItems()}
      </div>
    )
  }

}

export default JoinedRaceEn

if(document.getElementById('user-history-joined-en')){
    ReactDOM.render(<JoinedRaceEn />, document.getElementById('user-history-joined-en'))
}
