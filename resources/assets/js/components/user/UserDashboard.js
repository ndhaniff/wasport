import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Avatar } from 'antd';
import EditProfileModal from './components/EditProfileModal';
import axios from 'axios';
import CountUp from 'react-countup';

const Stats = (props) => {
  return (
    <div className="row text-center">
    <div className="col-md-4">
      {props.distance } <br/>
      Distance (KM)
    </div>
    <div className="col-md-4">
      {props.pace} <br/>
      Pace
    </div>
    <div className="col-md-4">
      {props.noofruns} <br/>
      No of runs
    </div>
  </div>
  )
}

class UserDashboard extends Component{

  constructor(){
    super();
    this.state = {
      distance : 0,
      pace : 0,
      no_of_runs : 0,
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
        <div className="bg-light p-5 container">
          <div className="row">
            <div className="col-sm-3">
              <Avatar size={90} icon="user" />
              <EditProfileModal/>
            </div>
            <div className="col-sm-9">
              <Stats 
                distance={this.state.distance}
                pace={this.state.pace}
                noofruns={this.state.no_of_runs}
              />
              <hr/>
            </div>
          </div>
        </div>
      </div>
    )
  }

}

export default UserDashboard

if(document.getElementById('user-dashboard')){
    ReactDOM.render(<UserDashboard />, document.getElementById('user-dashboard'))
}