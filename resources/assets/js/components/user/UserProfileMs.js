import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Avatar, Tabs } from 'antd';
import EditProfileModal from './components/EditProfileModalMs';
import axios from 'axios';
import CountUp from 'react-countup';

class UserProfileMs extends Component{

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
      return "Tambah cogan kata anda";
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
            <div className="col-sm-2" id="user-profile-left">
              {this.renderAvatar()}
            </div>

            <div className="col-sm-10" id="user-profile-right">
              <div className="userprofile-name">{this.state.name}</div>
              <div className="userprofile-motto">{this.renderMotto()}</div>
              <div className="userprofile-id">ID Pengguna : {this.state.id}</div>

              <EditProfileModal/>
            </div>
          </div>

      </div>
    )
  }

}

export default UserProfileMs

if(document.getElementById('user-profile-ms')){
    ReactDOM.render(<UserProfileMs />, document.getElementById('user-profile-ms'))
}
