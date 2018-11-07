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
      <span>Jarak (KM)</span>
    </div>
    <div className="col-md-4" id="border-right">
      <img src={timeLogo} alt="Pace" /> <br/>
      <h6>{props.pace}</h6>
      <span>Kecepatan</span>
    </div>
    <div className="col-md-4">
      <img src={runLogo} alt="Number of runs" /> <br/>
      <h6>{props.noofruns}</h6>
      <span>Jumlah Larian</span>
    </div>
  </div>
  )
}

class UserStravaMs extends Component{

  constructor(){
    super();
    this.state = {
      allorder: window.allorder,
      distance : '-',
      pace : '-',
      no_of_runs : '-'
    }
  }

  componentDidMount(){

    let no_of_runs = 0
    let race_distance = 0
    let total_time = 0
    let hour = 0
    let minute = 0
    let second = 0

    //get user data for wasports
    for(var i=0; i<allsubmissions.length; i++) {
      no_of_runs += 1
      race_distance += Number(allsubmissions[i]['s_distance'])

      hour += Number(allsubmissions[i]['s_hour'])
      minute += Number(allsubmissions[i]['s_minute'])
      second += Number(allsubmissions[i]['s_second'])
    }

    //calcaule total time in seconds
    total_time = (hour * 60 * 60) + (minute * 60) + second

    if(typeof window.token != "undefined" && typeof window.strava_id != "undefined"){
      let api_url = "/strava/getStats/";
      axios.post(api_url, {
        id : window.strava_id,
        access_token : window.strava_token
      })
      .then((res) => {
        if(res.status == 200){

          let data = res.data.data
          /* Calculate Pace */
          let distance_pace = data.all_run_totals.distance / 1000 + race_distance;
          let pace = (data.all_run_totals.moving_time + total_time) / distance_pace;

          //get min from pace
          let min = Math.floor(pace / 60);
          //add 0 before if lower than 10
          min = (min > 10) ? min : '0' + min;
          //getting remaining seconds
          let sec = pace % 60;
          //adding 0 before, if lower than 10
          sec = (sec > 10) ? sec : '0' + sec;
          //set pace
          let avg_pace = min + "\"" + Math.floor(sec);
          //set distance
          let distance = distance_pace;
          no_of_runs += data.all_run_totals.count;

          //insert data
          this.setState({
            distance : distance.toFixed(2),
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
            noofruns={this.state.no_of_runs} />
      </div>
    )
  }

}

export default UserStravaMs

if(document.getElementById('user-strava-ms')){
    ReactDOM.render(<UserStravaMs />, document.getElementById('user-strava-ms'))
}
