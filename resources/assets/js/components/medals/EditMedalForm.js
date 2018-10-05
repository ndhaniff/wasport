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

export default class EditMedalForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            name : window.medal.name,
            races_id : window.medal.races_id,
            medal_grey : window.medal.medal_grey,
            medal_color : window.medal.medal_color,
            bib : window.medal.bib,
            cert : window.medal.cert,
            mid : window.medal.mid,
            toggleDrop_medalGrey: window.medal.toggleDrop_medalGrey,
            toggleDrop_medalColor: window.medal.toggleDrop_medalColor,
            toggleDrop_cert : window.medal.toggleDrop_cert,
            toggleDrop_bib : window.medal.toggleDrop_bib,
        }

        this.onDrop_medalGrey = this.onDrop_medalGrey.bind(this)
        this.onDrop_medalColor = this.onDrop_medalColor.bind(this)
        this.onDrop_cert = this.onDrop_cert.bind(this)
        this.onDrop_bib = this.onDrop_bib.bind(this)
        this.removePreview_medalGrey = this.removePreview_medalGrey.bind(this)
        this.removePreview_medalColor = this.removePreview_medalColor.bind(this)
        this.removePreview_cert = this.removePreview_cert.bind(this)
        this.removePreview_bib = this.removePreview_bib.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleRaceChange = this.handleRaceChange.bind(this)
    }

    createSelectItems() {
      let items = [];

      for(var i=0; i<races.length; i++) {
        items.push(<option key={races[i]['rid']} value={races[i]['rid']}>{races[i]['title']}</option>);
      }

      return items;
    }

    handleSubmit(e){
        e.preventDefault()

        let {name, medal_grey, medal_color, cert, bib, races_id, mid} = this.state

        let data = new FormData;

        data.append('name', name)
        data.append('medal_grey', medal_grey[0])
        data.append('medal_color', medal_color[0])
        data.append('cert', cert[0])
        data.append('bib', bib[0])
        data.append('races_id', races_id)
        data.append('mid', mid)

        let message = [];
        let messageF = '';

        if(typeof medal_grey[0] != 'undefined') { message.push('Grey Medal') }
        if(typeof medal_color[0] != 'undefined') { message.push('Color Medal') }
        if(typeof cert[0] != 'undefined') { message.push('Cert') }
        if(typeof bib[0] != 'undefined') { message.push('Bib') }
        if(races_id == '') { message.push('Races') }

        messageF = message.join(', ')

        if(message.length != 0) {

          MySwal.fire({
            title: 'These fields are empty',
            text: messageF,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Update medal anyway',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33'
          }).then((result) => {
            if (result.value) {

              axios.post('/admin/medals/edit',data).then((res) => {
                  if(res.data.success){

                      MySwal.fire({
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        type: 'success',
                        title: 'Medal updated'
                      })

                      window.setTimeout(function(){
                        location.href = location.origin + '/admin/medals/edit/'+res.data.mid
                      } ,3000);

                  } else {
                      alert('something wrong')
                  }
              })

            }
          })

        } else {

          axios.post('/admin/medals/edit',data).then((res) => {
              if(res.data.success){

                  MySwal.fire({
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    type: 'success',
                    title: 'Medal updated'
                  })

                  window.setTimeout(function(){
                    location.href = location.origin + '/admin/medals/edit/'+res.data.mid
                  } ,3000);

              } else {
                  alert('something wrong')
              }
          })

        }

    }

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    handleRaceChange(event) {
      this.setState({races_id: event.target.value});
    }

    onDrop_medalGrey(acceptedFiles, rejectedFiles) {
        this.setState({medal_grey: acceptedFiles,toggleDrop_medalGrey:false})
    }

    onDrop_medalColor(acceptedFiles, rejectedFiles) {
        this.setState({medal_color: acceptedFiles,toggleDrop_medalColor:false})
    }

    onDrop_cert(acceptedFiles, rejectedFiles) {
        this.setState({cert: acceptedFiles,toggleDrop_cert:false})
    }

    onDrop_bib(acceptedFiles, rejectedFiles) {
        this.setState({bib: acceptedFiles,toggleDrop_bib:false})
    }

    removePreview_medalGrey(){
        this.setState({medal_grey: [],toggleDrop_medalGrey:true})
    }

    removePreview_medalColor(){
        this.setState({medal_color: [],toggleDrop_medalColor:true})
    }

    removePreview_cert(){
        this.setState({cert: [],toggleDrop_cert:true})
    }

    removePreview_bib(){
        this.setState({bib: [],toggleDrop_bib:true})
    }

    render() {
      //Grey Medal
      if(this.state.medal_grey.length != 0){
          var previewImg_medalGrey =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalGrey} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.medal_grey[0].preview} alt=""/></div>
      } else { var previewImg_medalGrey =  <img src="" alt=""/> }

      if(this.state.toggleDrop_medalGrey){
          var dropzone_medalGrey =
            <Dropzone
              style={{
              "width": "100%",
              "border": "1px dashed",
              "padding": "5%",}}
              accept="image/jpeg, image/png"
              onDrop={this.onDrop_medalGrey}
              multiple={false}
              name="medal_grey">
            <div className="text-center">
              <p>Try dropping some files here, or click to select files to upload.</p>
              <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
            </Dropzone>
        } else { var dropzone_medalGrey = "" }

        //Color Medal
        if(this.state.medal_color.length != 0){
            var previewImg_medalColor =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalColor} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.medal_color[0].preview} alt=""/></div>
        } else { var previewImg_medalColor =  <img src="" alt=""/> }

        if(this.state.toggleDrop_medalColor){
            var dropzone_medalColor =
              <Dropzone
                style={{
                "width": "100%",
                "border": "1px dashed",
                "padding": "5%",}}
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_medalColor}
                multiple={false}
                name="medal_color">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
          } else { var dropzone_medalColor = "" }

          //Cert
          if(this.state.cert.length != 0){
              var previewImg_cert =  <div className="mb-2 text-center"><button onClick={this.removePreview_cert} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.cert[0].preview} alt=""/></div>
          } else { var previewImg_cert =  <img src="" alt=""/> }

          if(this.state.toggleDrop_cert){
              var dropzone_cert =
                <Dropzone
                  style={{
                  "width": "100%",
                  "border": "1px dashed",
                  "padding": "5%",}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_cert}
                  multiple={false}
                  name="cert">
                <div className="text-center" id="form-text">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
            } else { var dropzone_cert = "" }

          //bib
          if(this.state.bib.length != 0){
              var previewImg_bib =  <div className="mb-2 text-center"><button onClick={this.removePreview_bib} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.bib[0].preview} alt=""/></div>
          } else {
              var previewImg_bib =  <img src="" alt=""/>
          }

          if(this.state.toggleDrop_bib){
              var dropzone_bib =
                <Dropzone
                  style={{
                  "width": "100%",
                  "border": "1px dashed",
                  "padding": "5%",}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_bib}
                  multiple={false}
                  name="cert">
                <div className="text-center" id="form-text">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
            } else { var dropzone_bib = "" }

        return (

            <div className="wrapper p-1">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">Edit Medal</div>

                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                  <div className="form-row">
                                    <div className="col-sm-12 col-md-3">
                                      <div className="form-group">
                                        <label>Name<span className="required-field">*</span></label>
                                        <input onChange={this.handleInputChange} value={this.state.name} name="name" className="form-control" type="text" required/>
                                      </div>
                                    </div>

                                    <div className="col-sm-12 col-md-4">
                                      <div className="form-group">
                                        <label>Race Title</label>
                                        <select value={this.state.races_id} onChange={this.handleRaceChange} style={{'display': 'block'}} className="form-select" required>
                                          <option disabled value=""> -- select an option -- </option>
                                          {this.createSelectItems()}
                                        </select>
                                      </div>
                                    </div>

                                  </div>

                                  <br />

                                  <div className="form-group">
                                      <Tabs defaultActiveKey="1" type="card">
                                          <TabPane tab="Grey" key="1">
                                              <label htmlFor="medalGrey">Medal</label>
                                              {previewImg_medalGrey}
                                              {dropzone_medalGrey}
                                          </TabPane>
                                          <TabPane tab="Color" key="2">
                                              <label htmlFor="e">Medal</label>
                                              {previewImg_medalColor}
                                              {dropzone_medalColor}
                                          </TabPane>
                                      </Tabs>
                                  </div>

                                  <br /><br />


                                  <div className="form-group">
                                    <label>Certificate</label>
                                    {previewImg_cert}
                                    {dropzone_cert}
                                  </div>

                                  <br /><br />

                                  <div className="form-group">
                                    <label>Bib</label>
                                    {previewImg_bib}
                                    {dropzone_bib}
                                  </div>

                                  <br/>

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

if(document.getElementById('editmedalform')){
    ReactDOM.render(<EditMedalForm />, document.getElementById('editmedalform'))
}
