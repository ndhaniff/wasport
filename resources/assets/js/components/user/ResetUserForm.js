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

export default class ResetUserForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            password: '',
            id: window.user.id,
            email: window.user.email,
            name: window.user.name,
        }

        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
    }

    handleSubmit(e){
        e.preventDefault()

        let {password,id} = this.state

        let data = new FormData;

        data.append('password', password)
        data.append('id', id)

        axios.post('/admin/users/reset',data).then((res) => {
            if(res.data.success){

                MySwal.fire({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  type: 'success',
                  title: 'Password reset successfully'
                })

                window.setTimeout(function(){
                  location.href = location.origin + '/admin/users'
                } ,3000);

            } else {
                alert('something wrong')
            }
        })
    }

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    render() {

          return (

              <div className="wrapper p-1">
                  <div className="row">
                      <div className="col-md-12">
                          <div className="card">
                              <div className="card-header">Reset Password for</div>

                              <div className="card-body">
                                  <p>User ID: {this.state.id}<br />
                                    Name: {this.state.name}<br />
                                    Email: {this.state.email}</p>

                                  <form onSubmit={this.handleSubmit}>

                                      <div className="form-group">
                                      <div className="form-row">
                                        <div className="col-sm-12 col-md-3">
                                          <div className="form-group">
                                              <label>Password<span className="required-field">*</span></label>
                                              <input onChange={this.handleInputChange} value={this.state.password} name="password" className="form-control" type="text" min='6' required/>
                                          </div>
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

  if(document.getElementById('resetuserform')){
      ReactDOM.render(<ResetUserForm />, document.getElementById('resetuserform'))
  }
