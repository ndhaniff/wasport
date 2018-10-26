import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './BibModalEn';

const submitIC = window.location.origin + '/img/ic-submit.png';
const rankIC = window.location.origin + '/img/ic-rank.png';
const certIC = window.location.origin + '/img/ic-cert.png';
const infoIC = window.location.origin + '/img/ic-info.png';

class CurrentJoinedEn extends Component{

  constructor(){
    super();
    this.state = {
      current : window.current,
    }
  }

  createRaceItems() {
    let items = [];

    for(var i=0; i<current.length; i++) {
      if(current[i]['submission'] == 'false') {
        items.push(
          <div className="col-sm-12 col-md-6">
            <div className="user-history-joined">
              <img src={current[i]['header']} style={{width: '100%'}}/>

              <div className="user-history-joined-content">
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{current[i]['title_en']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{current[i]['date']}</p>
                <Progress percent={0} showInfo={false}/>
                <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{current[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span className="submission-info">Submission opens when the race start</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-4">
                    <Button>
                      <img src= {rankIC} /><br />
                      <span>Rankings</span></Button>
                  </div>
                  <div className="col-sm-4">
                    <BibModal raceCategory = {current[i]['category']} raceID = {current[i]['rid']} />
                  </div>
                  <div className="col-sm-4">
                    <Button>
                      <img src= {certIC} /><br />
                      <span>Certificate</span></Button>
                  </div>
                </div>
              </div>
            </div>
          </div>)
      }

      if(current[i]['submission'] == 'true') {
        items.push(
          <div className="col-sm-12 col-md-6">
            <div className="user-history-joined">
              <img src={current[i]['header']} style={{width: '100%'}}/>

              <div className="user-history-joined-content">
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{current[i]['title_en']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{current[i]['date']}</p>
                <Progress percent={0} showInfo={false}/>
                <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{current[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span className="submission-info">You can now submit your race</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-3">
                    <Button>
                      <img src= {submitIC} /><br />
                      <span>Submission</span></Button>
                  </div>
                  <div className="col-sm-3">
                    <Button>
                      <img src= {rankIC} /><br />
                      <span>Rankings</span></Button>
                  </div>
                  <div className="col-sm-3">
                    <BibModal raceCategory = {current[i]['category']} raceID = {current[i]['rid']} />
                  </div>
                  <div className="col-sm-3">
                    <Button>
                      <img src= {certIC} /><br />
                      <span>Certificate</span></Button>
                  </div>
                </div>
              </div>
            </div>
          </div>)
      }

    }

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

export default CurrentJoinedEn

if(document.getElementById('current-joined-en')){
    ReactDOM.render(<CurrentJoinedEn />, document.getElementById('current-joined-en'))
}
