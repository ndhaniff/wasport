import React, { Component } from 'react'
import {Tabs,Button, Divider } from 'antd'
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
import Submission from './SubmitFormEn'

const MySwal = withReactContent(Swal);
const TabPane = Tabs.TabPane;

function callback(key) {
  console.log(key);
}

class SubmitTabsEn extends Component{

  constructor(){
    super()
    this.form = React.createRef();
    this.state = {
      allsubmissions: window.allsubmissions
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

        items.push(<tr><td>{i+1 + '.'} </td>
                        <td>{allsubmissions[i]['s_distance']}</td>
                        <td>{time_taken}</td>
                        <td><Button id="delete-btn" onClick={this.handleDelete} value={allsubmissions[i]['sid']}>DELETE</Button></td></tr>);
      }
    }

    return items;
  }

  handleDelete(e) {

    let delete_url = "/user/deleteSubmission/";
    axios.post(delete_url, {
      sid : e.target.value
    }).then((res) => {

        if(res.status == 200){
          MySwal.fire({
            type: 'success',
            title: 'Record deleted',
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
      var historyTable = <span><center>NO RECORD AVAILABLE</center></span>
    } else {
      var latestMsg = <span style={{color: 'red'}}>Only the latest record take count</span>
      var historyTable = <table id="submission-history-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Distance(km)</th>
            <th>Time Taken</th>
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
        <TabPane tab="Submit Race" key="1">
          <Submission raceID = {this.props.raceID}/>
        </TabPane>
        <TabPane tab="Submission History" key="2">
          {latestMsg}
          {historyTable}
        </TabPane>
      </Tabs>
    )
  }

}

export default SubmitTabsEn
