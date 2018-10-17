import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import EditProfileModal from './components/EditProfileModal';
import axios from 'axios';
import CountUp from 'react-countup';

class UserProfileEn extends Component{

  constructor(){
    super();
    this.state = {
      id : window.user.id,
      name: window.user.name,
      motto: window.user.motto,
      profileimg : window.user.profileimg
    }
  }

  renderMotto(){
    if(this.state.motto == '')
      return "Add your motto";
    return this.state.motto;
  }

  renderAvatar(){
    var path = window.location.origin + '/storage/uploaded/users/' + this.state.profileimg
    if(this.state.profileimg == '')
      return <Avatar size={125} icon='user'/>
    return <Avatar size={125} icon='user' src={path}/>
  }

  render(){
    return(
      <div>

          <div className="row">
            <div className="col-sm-2">
              {this.renderAvatar()}
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

export default UserProfileEn

if(document.getElementById('user-profile-en')){
    ReactDOM.render(<UserProfileEn />, document.getElementById('user-profile-en'))
}
