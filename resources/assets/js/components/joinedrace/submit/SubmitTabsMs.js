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
        hour = (hour > 9) ? hour : '0' + hour

        let min = allsubmissions[i]['s_minute']
        min = (min > 9) ? min : '0' + min

        let sec = allsubmissions[i]['s_second']
        sec = (sec > 9) ? sec : '0' + sec

        let time_taken = hour + ":" + min + ":" + sec

        items.push(<tr><td>{Number(i+1) + '.'} </td>
                        <td>{allsubmissions[i]['s_distance']}</td>
                        <td>{time_taken}</td>
                        <td><Button id="delete-btn" onClick={this.handleDelete} value={allsubmissions[i]['sid']}>DELETE</Button></td></tr>);
      }
    }

    return items;
  }

  handleDelete(e) {
    console.log('value: ' + e.target.value);

    let delete_url = "/user/deleteSubmission/";
    axios.post(delete_url, {
      sid : e.target.value
    }).then((res) => {

        if(res.status == 200){
          MySwal.fire({
            type: 'success',
            title: 'Rekod deleted',
            showConfirmButton: false,
            timer: 3000,
          })

          window.setTimeout(function(){
            location.href = location.origin + '/dashboard'
          } ,3000);

        }
      })
  }

  render(){

    if (this.createHistoryItems() === undefined || this.createHistoryItems() == 0) {
      var latestMsg = ''
      var historyTable = <span><center>TIDAK ADA REKOD</center></span>
    } else {
      var latestMsg = <span style={{color: 'red'}}>Hanya rekod yang terbaru akan diambil</span>
      var historyTable = <table id="submission-history-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Jarak(km)</th>
            <th>Masa yang diambil</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          {this.createHistoryItems()}
        </tbody>
        </table>
    }

    return(
      <Tabs defaultActiveKey="1" onChange={callback}>
        <TabPane tab="Menyerah Acara" key="1">
          <Submission raceID = {this.props.raceID}/>
        </TabPane>
        <TabPane tab="Rekod Penyerahan" key="2">
          {latestMsg}
          {historyTable}
        </TabPane>
      </Tabs>
    )
  }

}

export default SubmitTabsMs
