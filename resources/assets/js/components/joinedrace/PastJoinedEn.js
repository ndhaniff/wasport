import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './BibModalEn';
import CertModal from './CertModalEn';

const submitIC = window.location.origin + '/img/ic-submit.png';
const rankIC = window.location.origin + '/img/ic-rank.png';
const infoIC = window.location.origin + '/img/ic-info.png';

class PastJoinedEn extends Component{

  constructor(){
    super();
    this.state = {
      past : window.past,
    }
  }

  createRaceItems() {
    let items = [];

    for(var i=0; i<past.length; i++) {

      if(past[i]['race_status'] == 'success') {
        items.push(
          <div className="col-sm-12 col-md-6">
            <div className="user-history-joined">
              <img src={past[i]['header']} style={{width: '100%'}}/>

              <div className="user-history-joined-content">
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{past[i]['title_en']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{past[i]['date']}</p>

                <Progress percent={100} showInfo={false}/>
                <span id="progress-race-start">100%</span><span id='progress-race-end'>{past[i]['category']}/{past[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span className="submission-info">Submission closed</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-4">
                    <Button>
                      <img src= {rankIC} /><br />
                      <span>Rankings</span></Button>
                  </div>
                  <div className="col-sm-4">
                    <BibModal raceCategory = {past[i]['category']} raceID = {past[i]['rid']} />
                  </div>
                  <div className="col-sm-4">
                    <CertModal raceCategory = {past[i]['category']} raceTitle = {past[i]['title_en']} raceID = {past[i]['rid']} raceStatus = {past[i]['race_status']} />
                  </div>
                </div>
              </div>
            </div>
          </div>)
      } else {
        items.push(
          <div className="col-sm-12 col-md-6">
            <div className="user-history-joined">
              <img src={past[i]['header']} style={{width: '100%'}}/>

              <div className="user-history-joined-content">
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{past[i]['title_en']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{past[i]['date']}</p>

                <Progress percent={0} showInfo={false}/>
                <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{past[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span className="submission-info">Submission closed</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-4">
                    <Button>
                      <img src= {rankIC} /><br />
                      <span>Rankings</span></Button>
                  </div>
                  <div className="col-sm-4">
                    <BibModal raceCategory = {past[i]['category']} raceID = {past[i]['rid']} />
                  </div>
                  <div className="col-sm-4">
                    <CertModal raceCategory = {past[i]['category']} raceTitle = {past[i]['title_en']} raceID = {past[i]['rid']} raceStatus = {past[i]['race_status']} />
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

export default PastJoinedEn

if(document.getElementById('past-joined-en')){
    ReactDOM.render(<PastJoinedEn />, document.getElementById('past-joined-en'))
}
