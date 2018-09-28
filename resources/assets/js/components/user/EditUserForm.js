import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill,{ Quill } from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone';
import Parser from 'html-react-parser';
import ImageResize from 'quill-image-resize-module';
import { Tabs } from 'antd';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const TabPane = Tabs.TabPane;

Quill.register("modules/imageResize", ImageResize);

export default class EditUserForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            name : window.user.name,
            email : window.user.email,
            firstname : window.user.firstname,
            lastname : window.user.lastname,
            motto : window.user.motto,
            phone : window.user.phone,
            gender : window.user.gender,
            add_fl : window.user.add_fl,
            add_sl : window.user.add_sl,
            city : window.user.city,
            state : window.user.state,
            postal : window.user.postal,
            profileimg : [{preview : window.user.profileimg}],
            toggleDrop: false,
            id : window.user.id,
        }

        this.onDrop = this.onDrop.bind(this)
        this.removePreview = this.removePreview.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleGenderChange = this.handleGenderChange.bind(this)
        this.handleStateChange = this.handleStateChange.bind(this)
    }

    handleSubmit(e){
        e.preventDefault()

        let {name,email,firstname,lastname,motto,phone,gender,add_fl,add_sl,city,state,postal,profileimg,id} = this.state

        let data = new FormData;

        data.append('name', name)
        data.append('email', email)
        data.append('firstname', firstname)
        data.append('lastname', lastname)
        data.append('motto', motto)
        data.append('phone', phone)
        data.append('add_fl', add_fl)
        data.append('add_sl', add_sl)
        data.append('city', city)
        data.append('state', state)
        data.append('postal', postal)
        data.append('profileimg', profileimg[0])
        data.append('id', id)

        axios.post('/admin/users/edit',data).then((res) => {
            if(res.data.success){

                MySwal.fire({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  type: 'success',
                  title: 'User updated'
                })

                window.setTimeout(function(){
                  location.href = location.origin + '/admin/users/edit/'+res.data.id
                } ,3000);

            } else {
                alert('something wrong')
            }
        })
    }

    onDrop(acceptedFiles, rejectedFiles) {
        this.setState({profileimg: acceptedFiles,toggleDrop:false})
    }

    removePreview(){
        this.setState({profileimg : [],toggleDrop:true})
    }

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    handleGenderChange(event) {
      this.setState({gender: event.target.value});
    }

    handleStateChange(event) {
      this.setState({state: event.target.value});
    }

    render() {

          if(this.state.profileimg.length != 0){
              var previewImg =  <div className="mb-2 text-center"><button onClick={this.removePreview} className="btn btn-danger float-right">X</button><br/><img height="300px" src= {(this.state.profileimg[0].preview)} alt=""/></div>
          } else {
              var previewImg =  <img src="" alt=""/>
          }

          if(this.state.toggleDrop){
              var dropzone =
           <Dropzone
              style={{
                  "width": "100%",
                  "border": "1px dashed",
                  "padding": "5%",}}
              accept="image/jpeg, image/png"
              onDrop={this.onDrop}
              multiple={false}
              name="profileimg">
              <div className="text-center">
              <p>Try dropping some files here, or click to select files to upload.</p>
              <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
          </Dropzone>
          } else {
              var dropzone = ""
          }

          return (

              <div className="wrapper p-1">
                  <div className="row">
                      <div className="col-md-12">
                          <div className="card">
                              <div className="card-header">Edit User</div>

                              <div className="card-body">
                                  <form onSubmit={this.handleSubmit}>
                                      <div className="form-group">
                                      {previewImg}
                                      {dropzone}
                                      </div>

                                      <br />

                                      <div className="form-group">
                                      <div className="form-row">
                                        <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Display name<span className="required-field">*</span></label>
                                              <input onChange={this.handleInputChange} value={this.state.name} name="name" className="form-control" type="text" required/>
                                          </div>
                                        </div>

                                        <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Email<span className="required-field">*</span></label>
                                              <input onChange={this.handleInputChange} value={this.state.email} name="email" className="form-control" type="text" required/>
                                          </div>
                                        </div>

                                        <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>First name</label>
                                              <input onChange={this.handleInputChange} value={this.state.firstname} name="firstname" className="form-control" type="text" />
                                          </div>
                                        </div>

                                        <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Last name</label>
                                              <input onChange={this.handleInputChange} value={this.state.lastname} name="lastname" className="form-control" type="text" />
                                          </div>
                                        </div>
                                      </div>
                                      </div>

                                      <div className="form-row">
                                      <div className="col-sm-12 col-md-3">
                                        <div className="form-group">
                                          <label>Motto</label>
                                          <input onChange={this.handleInputChange} name="motto" className="form-control" type="text" />
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Phone</label>
                                              <div className="form-row">
                                                <div className="col-sm-2">
                                                  <input className="phone-disable" value="601" disabled />
                                                </div>
                                                <div className="col-sm-10">
                                                  <input onChange={this.handleInputChange} value={this.state.phone} name="phone" className="form-control" type="number"/>
                                                </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                          <label>Gender</label>
                                          <select value={this.state.gender} onChange={this.handleGenderChange} style={{'display': 'block'}} className="form-select">
                                            <option value="">-</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                          </select>
                                          </div>
                                      </div>
                                      </div>

                                      <div className="form-row">
                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Address First Line</label>
                                              <input onChange={this.handleInputChange} value={this.state.add_fl} name="add_fl" className="form-control" type="text"/>
                                          </div>
                                      </div>

                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Address Second Line</label>
                                              <input onChange={this.handleInputChange} value={this.state.add_fl} name="add_sl" className="form-control" type="text"/>
                                          </div>
                                      </div>

                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>City</label>
                                              <input onChange={this.handleInputChange} value={this.state.city} name="city" className="form-control" type="text"/>
                                          </div>
                                      </div>

                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                          <label>State</label>
                                          <select value={this.state.state} onChange={this.handleStateChange} style={{'display': 'block'}} className="form-select">
                                            <option value="">-</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option value="Labuan">Labuan</option>
                                            <option value="Melaka">Melaka</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Pulau Pinang">Pulau Pinang</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                          </select>
                                          </div>
                                      </div>
                                      </div>

                                      <div className="form-row">
                                      <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Postal</label>
                                              <input onChange={this.handleInputChange} value={this.state.postal} name="postal" className="form-control" type="number"/>
                                          </div>
                                      </div>
                                      </div>

                                      <br/><br/>
                                      <button className="btn btn-primary" type="submit">Submit</button>
                                  </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
          );
      }
  }

  if(document.getElementById('edituserform')){
      ReactDOM.render(<EditUserForm />, document.getElementById('edituserform'))
  }
