import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './BibModalEn';

const submitIC = window.location.origin + '/img/ic-submit.png';
const rankIC = window.location.origin + '/img/ic-rank.png';
const certIC = window.location.origin + '/img/ic-cert.png';

class PastJoinedZh extends Component{

  constructor(){
    super();
    this.state = {
      past : window.past,
    }
  }

  createRaceItems() {
    let items = [];

    for(var i=0; i<past.length; i++) {
      items.push(
        <div className="col-sm-12 col-md-6">
          <div className="user-history-joined">
            <img src={past[i]['header']} style={{width: '100%'}}/>

            <div className="user-history-joined-content">
              <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{past[i]['title_en']}</h4>
              <p style={{fontFamily: 'SourceSansPro-Light'}}>{past[i]['date']}</p>
              <Progress percent={0} showInfo={false}/>
              <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{past[i]['category']}</span>

              <hr />

              <div className="row" id="joined-race-footer">
                <div className="col-sm-4">
                  <Button>
                    <img src= {rankIC} /><br />
                    <span>排名</span></Button>
                </div>
                <div className="col-sm-4">
                  <BibModal raceCategory = {past[i]['category']} />
                </div>
                <div className="col-sm-4">
                  <Button>
                    <img src= {certIC} /><br />
                    <span>证书</span></Button>
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

export default PastJoinedZh

if(document.getElementById('past-joined-zh')){
    ReactDOM.render(<PastJoinedZh />, document.getElementById('past-joined-zh'))
}
