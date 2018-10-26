import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './BibModalMs';

const submitIC = window.location.origin + '/img/ic-submit.png';
const rankIC = window.location.origin + '/img/ic-rank.png';
const certIC = window.location.origin + '/img/ic-cert.png';

class CurrentJoinedMs extends Component{

  constructor(){
    super();
    this.state = {
      current : window.current,
    }
  }

  createRaceItems() {
    let items = [];

    for(var i=0; i<current.length; i++) {
      items.push(
        <div className="col-sm-12 col-md-6">
          <div className="user-history-joined">
            <img src={current[i]['header']} style={{width: '100%'}}/>

            <div className="user-history-joined-content">
              <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{current[i]['title_ms']}</h4>
              <p style={{fontFamily: 'SourceSansPro-Light'}}>{current[i]['date']}</p>
              <Progress percent={0} showInfo={false}/>
              <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{current[i]['category']}</span>

              <hr />

              <div className="row" id="joined-race-footer">
                <div className="col-sm-4">
                  <Button>
                    <img src= {rankIC} /><br />
                    <span>Kedudukan</span></Button>
                </div>
                <div className="col-sm-4">
                  <BibModal raceCategory = {current[i]['category']} />
                </div>
                <div className="col-sm-4">
                  <Button>
                    <img src= {certIC} /><br />
                    <span>Sijil</span></Button>
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

export default CurrentJoinedMs

if(document.getElementById('current-joined-ms')){
    ReactDOM.render(<CurrentJoinedMs />, document.getElementById('current-joined-ms'))
}
