import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button,Tabs, Progress } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';
import BibModal from './BibModalZh';

const submitIC = window.location.origin + '/img/ic-submit.png';
const rankIC = window.location.origin + '/img/ic-rank.png';
const certIC = window.location.origin + '/img/ic-cert.png';
const infoIC = window.location.origin + '/img/ic-info.png';

class CurrentJoinedZh extends Component{

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
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{current[i]['title_zh']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{current[i]['date']}</p>
                <Progress percent={0} showInfo={false}/>
                <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{current[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span class="submission-info">当比赛开始，您将可以上传您的跑步记录</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-4">
                    <Button>
                      <img src= {rankIC} /><br />
                      <span>排名</span></Button>
                  </div>
                  <div className="col-sm-4">
                    <BibModal raceCategory = {current[i]['category']} />
                  </div>
                  <div className="col-sm-4">
                    <Button>
                      <img src= {certIC} /><br />
                      <span>证书</span></Button>
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
                <h4 style={{fontFamily: 'SourceSansPro-Semibold'}}>{current[i]['title_zh']}</h4>
                <p style={{fontFamily: 'SourceSansPro-Light'}}>{current[i]['date']}</p>
                <Progress percent={0} showInfo={false}/>
                <span id="progress-race-start">0%</span><span id='progress-race-end'>0/{current[i]['category']}</span><br />

                <div className="submission-info-row">
                  <img src= {infoIC} /><span class="submission-info">现在可以提交成绩</span>
                </div>
                <hr />

                <div className="row" id="joined-race-footer">
                  <div className="col-sm-3">
                    <Button>
                      <img src= {submitIC} /><br />
                      <span>提交</span></Button>
                  </div>
                  <div className="col-sm-3">
                    <Button>
                      <img src= {rankIC} /><br />
                      <span>排名</span></Button>
                  </div>
                  <div className="col-sm-3">
                    <BibModal raceCategory = {current[i]['category']} />
                  </div>
                  <div className="col-sm-3">
                    <Button>
                      <img src= {certIC} /><br />
                      <span>证书</span></Button>
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

export default CurrentJoinedZh

if(document.getElementById('current-joined-zh')){
    ReactDOM.render(<CurrentJoinedZh />, document.getElementById('current-joined-zh'))
}
