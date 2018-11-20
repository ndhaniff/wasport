import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './bib/BibModalEn';
import CertModal from './cert/CertModalEn';
import SubmitModal from './submit/SubmitModalEn';

const rankIC = window.location.origin + '/img/ic-rank.png';
const infoIC = window.location.origin + '/img/ic-info.png';

class JoinedRaceEn extends Component{

  constructor(){
    super();
    this.state = {
      race : window.race
    }
  }

  createRaceItems() {
    let items = [];

    for(var i=0; i<race.length; i++) {
      if(race[i]['submission'] == 'false') {
        if(race[i]['race_status'] == 'success') {
          items.push(
            <div className="col-sm-12 col-md-6">
              <div className="user-history-joined">
                <img src={race[i]['header']} style={{width: '100%'}}/>

                <div className="user-history-joined-content">
                  <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{race[i]['title_en']}</h4>
                  <p style={{fontFamily: 'SourceSansPro-Light'}}>{race[i]['date']}</p>
                  <Progress percent={100} showInfo={false}/>
                  <span id="progress-race-start">100%</span><span id='progress-race-end'>{race[i]['category']}/{race[i]['category']}</span><br />

                  <div className="submission-info-row">
                    <img src= {infoIC} /><span className="submission-info">Submission closed</span>
                  </div>
                  <hr />

                  <div className="row" id="joined-race-footer">
                    <div className="col-sm-4">
                      <a href= {'/ranking/' + race[i]['rid']}><Button>
                        <img src= {rankIC} /><br />
                        <span>Rankings</span></Button></a>
                    </div>
                    <div className="col-sm-4">
                      <BibModal raceCategory = {race[i]['category']} raceID = {race[i]['rid']}/>
                    </div>
                    <div className="col-sm-4">
                      <CertModal raceCategory = {race[i]['category']} raceTitle = {race[i]['title_en']} raceID = {race[i]['rid']} raceStatus = {race[i]['race_status']} />
                    </div>
                  </div>
                </div>
              </div>
            </div>)
        } else {
          items.push(
            <div className="col-sm-12 col-md-6">
              <div className="user-history-joined">
                <img src={race[i]['header']} style={{width: '100%'}}/>

                <div className="user-history-joined-content">
                  <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{race[i]['title_en']}</h4>
                  <p style={{fontFamily: 'SourceSansPro-Light'}}>{race[i]['date']}</p>
                  <Progress percent={0} showInfo={false}/>
                  <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{race[i]['category']}</span><br />

                  <div className="submission-info-row">
                    <img src= {infoIC} /><span className="submission-info">Submission opens when the race start</span>
                  </div>
                  <hr />

                  <div className="row" id="joined-race-footer">
                    <div className="col-sm-4">
                      <a href= {'/ranking/' + race[i]['rid']}><Button>
                        <img src= {rankIC} /><br />
                        <span>Rankings</span></Button></a>
                    </div>
                    <div className="col-sm-4">
                      <BibModal raceCategory = {race[i]['category']} raceID = {race[i]['rid']}/>
                    </div>
                    <div className="col-sm-4">
                      <CertModal raceCategory = {race[i]['category']} raceTitle = {race[i]['title_en']} raceID = {race[i]['rid']} raceStatus = {race[i]['race_status']} />
                    </div>
                  </div>
                </div>
              </div>
            </div>)
        }
      }

      if(race[i]['submission'] == 'true') {
        items.push(
          <div className="col-sm-12 col-md-6">
            <div className="user-history-joined">
              <img src={race[i]['header']} style={{width: '100%'}}/>

              <div className="user-history-joined-content">
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{race[i]['title_en']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{race[i]['date']}</p>
                <Progress percent={0} showInfo={false}/>
                <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{race[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span className="submission-info">You can now submit your race</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-3">
                      <SubmitModal raceID = {race[i]['rid']}/>
                  </div>
                  <div className="col-sm-3">
                    <a href= {'/ranking/' + race[i]['rid']}><Button>
                      <img src= {rankIC} /><br />
                      <span>Rankings</span></Button></a>
                  </div>
                  <div className="col-sm-3">
                    <BibModal raceCategory = {race[i]['category']} raceID = {race[i]['rid']} />
                  </div>
                  <div className="col-sm-3">
                    <CertModal raceCategory = {race[i]['category']} raceTitle = {race[i]['title_en']} raceID = {race[i]['rid']} raceStatus = {race[i]['race_status']} />
                  </div>
                </div>
              </div>
            </div>
          </div>)
      }

      if(race[i]['submission'] == 'closed') {
        if(race[i]['race_status'] == 'success') {
          items.push(
            <div className="col-sm-12 col-md-6">
              <div className="user-history-joined">
                <img src={race[i]['header']} style={{width: '100%'}}/>

                <div className="user-history-joined-content">
                  <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{race[i]['title_en']}</h4>
                  <p style={{fontFamily: 'SourceSansPro-Light'}}>{race[i]['date']}</p>
                  <Progress percent={100} showInfo={false}/>
                  <span id="progress-race-start">100%</span><span id='progress-race-end'>{race[i]['category']}/{race[i]['category']}</span><br />

                  <div className="submission-info-row">
                    <img src= {infoIC} /><span className="submission-info">Submission Closed</span>
                  </div>
                  <hr />

                  <div className="row" id="joined-race-footer">
                    <div className="col-sm-4">
                      <a href= {'/ranking/' + race[i]['rid']}><Button>
                        <img src= {rankIC} /><br />
                        <span>Rankings</span></Button></a>
                    </div>
                    <div className="col-sm-4">
                      <BibModal raceCategory = {race[i]['category']} raceID = {race[i]['rid']} />
                    </div>
                    <div className="col-sm-4">
                      <CertModal raceCategory = {race[i]['category']} raceTitle = {race[i]['title_en']} raceID = {race[i]['rid']} raceStatus = {race[i]['race_status']} />
                    </div>
                  </div>
                </div>
              </div>
            </div>)
        } else {
          items.push(
            <div className="col-sm-12 col-md-6">
              <div className="user-history-joined">
                <img src={race[i]['header']} style={{width: '100%'}}/>

                <div className="user-history-joined-content">
                  <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{race[i]['title_en']}</h4>
                  <p style={{fontFamily: 'SourceSansPro-Light'}}>{race[i]['date']}</p>
                  <Progress percent={0} showInfo={false}/>
                  <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{race[i]['category']}</span><br />

                  <div className="submission-info-row">
                    <img src= {infoIC} /><span className="submission-info">Submission Closed</span>
                  </div>
                  <hr />

                  <div className="row" id="joined-race-footer">
                    <div className="col-sm-4">
                      <a href= {'/ranking/' + race[i]['rid']}><Button>
                        <img src= {rankIC} /><br />
                        <span>Rankings</span></Button></a>
                    </div>
                    <div className="col-sm-4">
                      <BibModal raceCategory = {race[i]['category']} raceID = {race[i]['rid']} />
                    </div>
                    <div className="col-sm-4">
                      <CertModal raceCategory = {race[i]['category']} raceTitle = {race[i]['title_en']} raceID = {race[i]['rid']} raceStatus = {race[i]['race_status']} />
                    </div>
                  </div>
                </div>
              </div>
            </div>)
        }
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

export default JoinedRaceEn

if(document.getElementById('user-history-joined-en')){
    ReactDOM.render(<JoinedRaceEn />, document.getElementById('user-history-joined-en'))
}
