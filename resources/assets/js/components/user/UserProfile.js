import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Avatar, Tabs } from 'antd';
import EditProfileModal from './components/EditProfileModal';
import axios from 'axios';
import CountUp from 'react-countup';

class UserProfile extends Component{

  constructor(){
    super();
    this.state = {
      id : window.user.id,
      name: window.user.name,
      motto: window.user.motto,
    }
  }

  renderMotto(){
    if(this.state.motto == '')
      return "Add your motto";
    return this.state.motto;
  }

  render(){
    return(
      <div>

          <div className="row">
            <div className="col-sm-2">
              <Avatar size={125} icon="user" />
            </div>

            <div className="col-sm-10">
              <div className="userprofile-name">{this.state.name}</div>
              <div className="userprofile-motto">{this.renderMotto()}</div>
              <div className="userprofile-id">User ID : {this.state.id}</div>

              <EditProfileModal/>
            </div>
          </div>

      </div>

    )
  }

}

export default UserProfile

if(document.getElementById('user-profile')){
    ReactDOM.render(<UserProfile />, document.getElementById('user-profile'))
}
