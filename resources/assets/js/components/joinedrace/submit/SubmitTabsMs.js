import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'
import Submission from './SubmitFormMs'

const TabPane = Tabs.TabPane;

function callback(key) {
  console.log(key);
}

class SubmitTabsMs extends Component{

  constructor(){
    super()
    this.form = React.createRef();
    this.state = {
      allsubmissions: window.allsubmissions,
    }
  }

  createHistoryItems() {
    let items = [];

    for(var i=0; i<allsubmissions.length; i++) {
      if(allsubmissions[i]['race_id'] == this.props.raceID) {

        let hour = allsubmissions[i]['s_hour']
        hour = (hour > 10) ? hour : '0' + hour

        let min = allsubmissions[i]['s_minute']
        min = (min > 10) ? min : '0' + min

        let sec = allsubmissions[i]['s_second']
        sec = (sec > 10) ? sec : '0' + sec

        let time_taken = hour + ":" + min + ":" + sec

        items.push(<tr><td>{i+1 + '.'} </td><td>{allsubmissions[i]['s_distance']}</td><td>{time_taken}</td></tr>);
      }
    }

    return items;
  }

  render(){

    var historyTable = <table id="submission-history-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Jarak(km)</th>
          <th>Masa yang diambil</th>
        </tr>
      </thead>
      <tbody>
        {this.createHistoryItems()}
      </tbody>
      </table>

    return(
      <Tabs defaultActiveKey="1" onChange={callback}>
        <TabPane tab="Menyerah Acara" key="1">
          <Submission raceID = {this.props.raceID}/>
        </TabPane>
        <TabPane tab="Rekod Penyerahan" key="2">
          {historyTable}
        </TabPane>
      </Tabs>
    )
  }

}

export default SubmitTabsMs
