import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Avatar, Tabs } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';

const TabPane = Tabs.TabPane;

const distanceLogo = window.location.origin + '/img/strava-distance.png';
const timeLogo = window.location.origin + '/img/strava-time.png';
const runLogo = window.location.origin + '/img/strava-run.png';

const Stats = (props) => {
  return (
    <div className="row text-center">
    <div className="col-md-4" id="border-right">
      <img src= {distanceLogo} alt="Distance" /> <br/>
      <h6>{props.distance}</h6>
      <b>距离 (KM)</b>
    </div>
    <div className="col-md-4" id="border-right">
      <img src={timeLogo} alt="Pace" /> <br/>
      <h6>{props.pace}</h6>
      <b>配速</b>
    </div>
    <div className="col-md-4">
      <img src={runLogo} alt="Number of runs" /> <br/>
      <h6>{props.noofruns}</h6>
      <b>跑步记录</b>
    </div>
  </div>
  )
}

class UserStravaZh extends Component{

  constructor(){
    super();
    this.state = {
      distance : '-',
      pace : '-',
      no_of_runs : '-'
    }
  }

  componentDidMount(){
    if(typeof window.token != "undefined" && typeof window.strava_id != "undefined"){
      let api_url = "/strava/getStats/";
      axios.post(api_url, {
        id : window.strava_id,
        access_token : window.token
      })
      .then((res) => {
        if(res.status == 200){

          let data = res.data.data
          /* Calculate Pace */
          let distance_pace = data.all_run_totals.distance / 1000
          let pace = data.all_run_totals.moving_time / distance_pace;

          //get min from pace
          let min = Math.floor(pace / 60);
          //add 0 before if lower than 10
          min = (min > 10) ? min : '0' + min;
          //getting remaining seconds
          let sec = pace % 60;
          //adding 0 before, if lower than 10
          sec = (sec > 10) ? sec : '0' + sec;
          //set pace
          let avg_pace = min + ":" + Math.floor(sec);
          //set distance
          let distance = distance_pace;
          let no_of_runs = data.all_run_totals.count;

          //insert data
          this.setState({
            distance : distance,
            pace : avg_pace,
            no_of_runs : no_of_runs,
          })
        }
      })
    }
  }

  render(){
    return(
      <div>

        <Stats
            distance={this.state.distance}
            pace={this.state.pace}
            noofruns={this.state.no_of_runs}
        />

      </div>
    )
  }

}

export default UserStravaZh

if(document.getElementById('user-strava-zh')){
    ReactDOM.render(<UserStravaZh />, document.getElementById('user-strava-zh'))
}
